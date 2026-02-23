<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

public function show($id)
{
    $album = Album::with('photos')->findOrFail($id);
    return view('album.show', compact('album'));
}
