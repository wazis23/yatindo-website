<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use App\Models\PostRevision;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
	 public function allNews()
    {
    $posts = Post::where('status','published')
        ->latest()
        ->paginate(6); // 6 berita per halaman

    return view('posts.all', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // Upload gambar
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
        $data['author_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('admin.posts.index');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // Jika upload gambar baru
       if ($request->hasFile('featured_image')) {

            // Hapus gambar lama
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

        return redirect()->route('admin.posts.index');
    }

 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return back();
    }

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

            // Simpan revision
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

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:5120'
        ]);

        $image = $request->file('upload');

        $manager = new \Intervention\Image\ImageManager(
            new \Intervention\Image\Drivers\Gd\Driver()
        );

        $img = $manager->read($image)
            ->cover(1200, 675)
            ->toWebp(75);

        $filename = 'editor_' . time() . '.webp';

        \Storage::disk('public')->put('posts/' . $filename, $img);

        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => asset('storage/posts/' . $filename)
        ]);
    }

    public function publish(Post $post)
    {
      $post->update([
        'status'=>'published',
        'published_at'=>now()
    ]);
	
   


       return back();
    }

}
