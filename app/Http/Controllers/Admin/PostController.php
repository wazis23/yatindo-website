<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use App\Models\PostRevision;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create posts')->only(['create','store']);
        $this->middleware('permission:edit posts')->only(['edit','update']);
        $this->middleware('permission:delete posts')->only(['destroy']);
        $this->middleware('permission:publish posts')->only(['publish','unpublish']);
    }

    /**
     * LIST POSTS
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * FRONTEND ALL NEWS
     */
    public function allNews()
    {
        $posts = Post::where('status','published')
            ->latest()
            ->paginate(6);

        return view('posts.all', compact('posts'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // Upload image
        if ($request->hasFile('featured_image')) {

            $image = $request->file('featured_image');
            $filename = time() . '.webp';

            $manager = new ImageManager(new Driver());

            $img = $manager->read($image)
                ->resize(1200, null)
                ->toWebp(75);

            Storage::disk('public')
                ->put('posts/' . $filename, $img);

            $data['featured_image'] = 'posts/' . $filename;
        }

        $data['slug'] = Post::generateUniqueSlug($data['title']);
        $data['status'] = 'draft';
        $data['published_at'] = null;
        $data['author_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success','Berita berhasil dibuat');
    }

    /**
     * EDIT
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('featured_image')) {

            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $image = $request->file('featured_image');
            $filename = time() . '.webp';

            $manager = new ImageManager(new Driver());

            $img = $manager->read($image)
                ->resize(1200, null)
                ->toWebp(75);

            Storage::disk('public')
                ->put('posts/' . $filename, $img);

            $data['featured_image'] = 'posts/' . $filename;
        }

        $data['slug'] = Post::generateUniqueSlug($data['title']);

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success','Berita berhasil diperbarui');
    }

    /**
     * DELETE
     */
    public function destroy(Post $post)
    {
        // Jika status sudah published
        if ($post->status === 'published') {

            // Content Maker tidak boleh hapus
            if (auth()->user()->hasRole('content-maker')) {
                return back()->withErrors([
                    'error' => 'Berita yang sudah dipublish tidak dapat dihapus'
                ]);
            }
        }

        $post->delete();

        return back()->with('success','Berita berhasil dihapus');
    }

    /**
     * AUTOSAVE
     */
    public function autosave(Request $request)
    {
        $post = Post::updateOrCreate(
            ['id' => $request->post_id],
            [
                'title' => $request->title ?? 'Draft Tanpa Judul',
                'content' => $request->content,
                'status' => 'draft',
                'author_id' => auth()->id(),
            ]
        );

        PostRevision::create([
            'post_id' => $post->id,
            'content' => $request->content,
            'edited_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'post_id' => $post->id
        ], 200);
    }

    /**
     * UPLOAD IMAGE (EDITOR)
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:5120'
        ]);

        $image = $request->file('upload');

        $manager = new ImageManager(new Driver());

        $img = $manager->read($image)
            ->cover(1200, 675)
            ->toWebp(75);

        $filename = 'editor_' . time() . '.webp';

        Storage::disk('public')->put('posts/' . $filename, $img);

        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => asset('storage/posts/' . $filename)
        ]);
    }

    /**
     * PUBLISH
     */
    public function publish(Post $post)
    {
        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return back()->with('success','Berita berhasil dipublish');
    }

    /**
     * UNPUBLISH
     */
    public function unpublish(Post $post)
    {
        $post->update([
            'status' => 'unpublished',
            'published_at' => null,
        ]);

        return back()->with('success','Berita berhasil diunpublish');
    }
}