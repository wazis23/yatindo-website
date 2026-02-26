<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $albums = Album::orderBy('title')->get();

        $query = Gallery::with('album')->latest();

        if ($request->album_id) {
            $query->where('album_id', $request->album_id);
        }

        $photos = $query->paginate(24);

        return view('admin.galleries.index', compact('photos','albums'));
    }


public function destroy(Gallery $gallery)
{
    // Hapus file dari storage
    if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
        Storage::disk('public')->delete($gallery->image);
    }

    $gallery->delete();

    return back()->with('success', 'Foto berhasil dihapus');
}

public function bulkDelete(Request $request)
{
    $ids = explode(',', $request->ids);

    if (empty($ids)) {
        return back()->with('error', 'Tidak ada foto dipilih');
    }

    $photos = Gallery::whereIn('id', $ids)->get();

    foreach ($photos as $photo) {

        // Hapus file dari storage
        if ($photo->image && Storage::disk('public')->exists($photo->image)) {
            Storage::disk('public')->delete($photo->image);
        }

        $photo->delete();
    }

    return back()->with('success', count($photos) . ' foto berhasil dihapus');
}

}