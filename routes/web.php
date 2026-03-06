<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AlbumPageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/maintenance', function () {
            return view('maintenance');
            })->name('maintenance');
            
/*
|--------------------------------------------------------------------------
| BERITA
|--------------------------------------------------------------------------
*/

Route::prefix('berita')
    ->name('frontend.posts.')
    ->group(function () {

        Route::get('/', [PostController::class, 'index'])
            ->name('index');

        Route::get('/{slug}', [PostController::class, 'show'])
            ->name('show');

});

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/

//Route::get('/guru', [TeacherController::class, 'index'])
  //  ->name('teachers.index');

/*
|--------------------------------------------------------------------------
| GALLERY
|--------------------------------------------------------------------------
*/

//Route::get('/gallery', [GalleryController::class, 'index'])
//    ->name('galleries.index');
Route::get('/galeri', [AlbumPageController::class,'index'])
    ->name('albums.index');
Route::get('/galeri/{id}', [AlbumPageController::class,'show'])
    ->name('albums.show');

    /*
/*
|--------------------------------------------------------------------------
| PROFIL
|--------------------------------------------------------------------------
*/


    Route::prefix('profil')
        ->name('profile.')
        ->group(function () {

            Route::get('/smp', [HomeController::class, 'smp'])
                ->name('smp');

    });


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        /*
        |---------------------------------------------------
        | DASHBOARD
        |---------------------------------------------------
        */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('permission:view dashboard')
            ->name('dashboard');


        /*
        |---------------------------------------------------
        | POSTS
        |---------------------------------------------------
        */
        Route::resource('posts', AdminPostController::class)
            ->middleware('permission:manage posts');

        Route::post('posts/{post}/publish',
            [AdminPostController::class, 'publish'])
            ->middleware('permission:publish posts')
            ->name('posts.publish');

        Route::post('posts/{post}/unpublish',
            [AdminPostController::class, 'unpublish'])
            ->middleware('permission:publish posts')
            ->name('posts.unpublish');

        Route::post('posts/autosave',
            [AdminPostController::class, 'autosave'])
            ->middleware('permission:manage posts')
            ->name('posts.autosave');

        Route::post('upload-image',
            [AdminPostController::class, 'uploadImage'])
            ->middleware('permission:manage posts')
            ->name('upload.image');


        /*
        |---------------------------------------------------
        | SLIDERS (Admin & Super Admin)
        |---------------------------------------------------
        */
        Route::resource('sliders', SliderController::class)
            ->middleware('permission:manage sliders');


        /*
        |---------------------------------------------------
        | GALLERIES
        |---------------------------------------------------
        */
        Route::post('galleries/{photo}/update-title',
            [AdminGalleryController::class, 'updateTitle'])
            ->middleware('permission:manage albums')
            ->name('galleries.updateTitle');

        Route::delete('galleries/bulk-delete',
            [AdminGalleryController::class,'bulkDelete'])
            ->middleware('permission:manage albums')
            ->name('galleries.bulkDelete');

        Route::resource('galleries', AdminGalleryController::class)
            ->middleware('permission:manage albums');


        /*
        |---------------------------------------------------
        | ALBUMS
        |---------------------------------------------------
        */
        Route::resource('albums', AdminAlbumController::class)
            ->middleware('permission:manage albums');

        Route::post('albums/{photo}/set-cover',
            [AdminAlbumController::class, 'setCover'])
            ->middleware('permission:manage albums')
            ->name('albums.setCover');

        Route::post('albums/{album}/upload',
            [AdminAlbumController::class, 'uploadPhotos'])
            ->middleware('permission:manage albums')
            ->name('albums.upload');


        /*
        |---------------------------------------------------
        | TEACHERS (Admin & Super Admin)
        |---------------------------------------------------
        */
        Route::post(
            'teachers/check-position',
            [AdminTeacherController::class, 'checkPosition']
        )->name('teachers.checkPosition');
        Route::resource('teachers', AdminTeacherController::class)
            ->middleware('permission:manage teachers');


        /*
        |---------------------------------------------------
        | USERS (Super Admin only)
        |---------------------------------------------------
        */
        Route::resource('users', UserController::class)
            ->middleware('permission:manage users');
        Route::post('users/verify-pin', [UserController::class, 'verifyPin'])
            ->name('users.verifyPin');

        /*
        |---------------------------------------------------
        | Settings (Super Admin only)
        |---------------------------------------------------
        */
        Route::get('settings', [SettingController::class,'edit'])
            ->middleware('permission:manage settings')
            ->name('settings.edit');

        Route::put('settings', [SettingController::class,'update'])
            ->middleware('permission:manage settings')
            ->name('settings.update');
        
        
    });


