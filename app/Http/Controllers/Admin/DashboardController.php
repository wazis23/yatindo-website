<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        return view('admin.dashboard', [
        'totalPosts' => \App\Models\Post::count(),
        'publishedPosts' => \App\Models\Post::where('status','published')->count(),
        'draftPosts' => \App\Models\Post::where('status','draft')->count(),
    ]);
    }
}
