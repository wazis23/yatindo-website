<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumPageController extends Controller
{
    public function index()
    {
        $albums = Album::with('photos')
            ->latest()
            ->get();

        return view('frontend.albums.index', compact('albums'));
    }

    public function show($id)
    {
        $album = Album::with('photos')
            ->findOrFail($id);

        return view('frontend.albums.show', compact('album'));
    }
}