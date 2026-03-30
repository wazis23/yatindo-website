<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Album;
use App\Models\Teacher;

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


    public function smp()
    {
        $principal = Teacher::with('position')
            ->where('unit', 'smp')
            ->whereHas('position', function ($query) {
                $query->where('name', 'Kepala Sekolah SMP');
            })
            ->where('is_active', 1)
            ->first();


        $teachers = Teacher::with([
                'position',
                'major'
            ])
            ->where('unit', 'smp')
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();


        /* ===============================
        Hero Slider SMP
        =============================== */

        $heroSliders = Slider::where('type', 'smp_hero')
            ->orderBy('order_no')
            ->get();


        return view(
            'frontend.profile.smp.index',
            compact(
                'principal',
                'teachers',
                'heroSliders'
            )
        );
    }

    public function smk()
    {
        $principal = Teacher::with('position')
            ->where('unit', 'smk')
            ->whereHas('position', function ($query) {
                $query->where('name', 'Kepala Sekolah SMK');
            })
            ->where('is_active', 1)
            ->first();

        $teachers = Teacher::with([
                'position',
                'major'
            ])
            ->where('unit', 'smk')
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();

        /* ===============================
        Hero Slider SMK
        =============================== */

        $heroSliders = Slider::where('type', 'smk_hero')
            ->orderBy('order_no')
            ->get();


        return view(
            'frontend.profile.smk.index',
            compact(
                'principal',
                'teachers',
                'heroSliders'
            )
        );
    }

    public function major($major)
    {

        $majorName = strtoupper($major);
        $majorTitle = config('frontend.majors.'.$major.'.name');
        $majorLogo = config('frontend.majors.'.$major.'.logo');

        /* ===============================
        HERO SLIDER JURUSAN
        =============================== */

        $heroSliders = Slider::where('type', $major.'_hero')
            ->orderBy('order_no')
            ->get();


        /* ===============================
        KEPALA PROGRAM
        =============================== */

        $kaprog = Teacher::with('position','major')
            ->where('unit', 'smk')
            ->whereHas('position', function ($query) {
                $query->where('name', 'Kepala Program');
            })
            ->whereHas('major', function ($query) use ($majorName) {
                $query->where('name', $majorName);
            })
            ->where('is_active', 1)
            ->first();


        /* ===============================
        GURU PRODUKTIF + TOOLMAN
        =============================== */

        $teachers = Teacher::with(['position','major'])
            ->where('unit', 'smk')
            ->whereHas('major', function ($query) use ($majorName) {
                $query->where('name', $majorName);
            })
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();


        return view(
            'frontend.profile.smk.'.$major.'.index',
            compact(
                'heroSliders',
                'kaprog',
                'teachers',
                'majorName',
                'majorTitle',
                'majorLogo'
            )
        );
    }
}
