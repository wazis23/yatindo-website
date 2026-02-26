<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Post::where('status','published');

        // Search
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('title','like','%'.$request->search.'%')
                ->orWhere('content','like','%'.$request->search.'%');
            });
        }

        // Filter Bulan
        if($request->month){
            $query->whereMonth('published_at', $request->month);
        }

        // Filter Tahun
        if($request->year){
            $query->whereYear('published_at', $request->year);
        }

        // Sort
        if($request->sort == 'oldest'){
            $query->oldest('published_at');
        } else {
            $query->latest('published_at');
        }

        $posts = $query->paginate(9);

        // Ambil tahun unik untuk filter
        $years = Post::whereNotNull('published_at')
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->pluck('year');

        return view('frontend.posts.index', compact('posts','years'));
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
    public function show($slug)
{
    $post = Post::where('slug',$slug)
        ->where('status','published')
        ->firstOrFail();

    $post->increment('views');
    
    $related = Post::where('status','published')
        ->where('id','!=',$post->id)
        ->latest()
        ->take(3)
        ->get();

    return view('frontend.posts.show', compact('post','related'));
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
