<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Album;

class HomeController extends Controller
{
    public function index()
    {
        // ===== BERITA =====
        $posts = Post::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        // ===== SLIDER =====
        $sliders = Slider::where('type', 'home_hero')
            ->orderBy('order_no')
            ->get();

        // ===== GALERI =====
        $galleries = Gallery::latest()
            ->take(8)
            ->get();

        // ===== ALBUM =====
        $albums = Album::with('photos')
            ->latest()
            ->get();

        return view('home', compact(
            'posts',
            'sliders',
            'galleries',
            'albums'
        ));
    }

    public function showAlbum(Album $album)
    {
        return view('album.show', compact('album'));
    }
}
