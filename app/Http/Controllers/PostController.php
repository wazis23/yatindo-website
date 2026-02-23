<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $imagePath = null;

    if ($request->hasFile('featured_image')) {
        $imagePath = $request->file('featured_image')->store('posts','public');
    }

    Post::create([
        'title' => $request->title,
        'slug' => \Str::slug($request->title),
        'content' => $request->content,
        'featured_image' => $imagePath, // penting
        'status' => 'draft',
        'author_id' => auth()->id(),
    ]);
        return redirect()->route('posts.index');
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
         $imagePath = $post->featured_image; // simpan gambar lama

    // Jika upload gambar baru
    if ($request->hasFile('featured_image')) {
        $imagePath = $request->file('featured_image')->store('posts','public');
    }

    $post->update([
        'title' => $request->title,
        'slug' => \Str::slug($request->title),
        'content' => $request->content,
        'featured_image' => $imagePath,
    ]);

    return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
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
