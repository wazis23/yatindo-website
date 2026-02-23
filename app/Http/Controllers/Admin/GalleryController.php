<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Album;

class GalleryController extends Controller
{
    // Tampilkan daftar galeri
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function updateTitle(Request $request, Gallery $photo)
{
    $photo->title = $request->title;
    $photo->save();

    return response()->json(['success' => true]);
}

    // Form upload
    public function create()
    {
        $albums = Album::all(); // ambil semua album
        return view('admin.galleries.create', compact('albums'));
    }

    // Simpan foto
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required',
        'image' => 'required|image',
        'category' => 'required|in:yayasan,sekolah,smp,smk'
    ]);

    $path = $request->file('image')->store('gallery','public');

    Gallery::create([
        'title' => $request->title,
        'image' => $path,
        'category' => $request->category,
		'album_id' => $request->album_id,
        'uploaded_by' => auth()->id()
    ]);

    return redirect()->route('galleries.index');
    }

    // Hapus foto
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back();
    }
}
