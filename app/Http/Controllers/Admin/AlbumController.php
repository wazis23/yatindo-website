<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


use App\Models\Album;
use App\Models\Gallery;


class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        Album::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category
        ]);

        return redirect()->route('admin.albums.index')->with('success','Album dibuat');
    }

    public function show(Album $album)
    {
        return view('admin.albums.show', compact('album'));
    }

    // ✅ UPLOAD FOTO + WATERMARK
    public function uploadPhotos(Request $request, Album $album)
    {
        $request->validate([
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:10240'
        ]);

        foreach ($request->file('photos') as $photo) {

            $manager = new ImageManager(new Driver());

			$image = $manager->read($photo->getRealPath());
			$watermark = $manager->read(public_path('watermark.png'));

			// resize proporsional
			$watermark->scale(width: 180);

			// tempel watermark dengan opacity 30%
			$image->place(
				$watermark,
				'bottom-right',
				30,
				30,
				opacity: 45
			);

            

            $filename = uniqid() . '.jpg';
            $path = 'albums/' . $filename;

            $image->toJpeg(80)->save(storage_path('app/public/' . $path));

            Gallery::create([
                'title'       => $album->title,
                'image'       => $path,
                'category'    => $album->category,
                'album_id'    => $album->id,
                'uploaded_by' => Auth::id()
            ]);
        }

        return response()->json(['success' => true]);
    }

    // ✅ SET COVER
    public function setCover($photoId)
    {
        $photo = Gallery::findOrFail($photoId);
        $album = Album::findOrFail($photo->album_id);

        $album->cover_photo_id = $photoId;
        $album->save();

        return back()->with('success', 'Cover album diperbarui');
    }

    public function edit(Album $album)
    {
       return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $album->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Album berhasil diperbarui');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return back();
    }
}
