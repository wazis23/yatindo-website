<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryPageController extends Controller
{
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('gallery.show', compact('gallery'));
    }
}
