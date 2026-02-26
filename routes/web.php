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
/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

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
|--------------------------------------------------------------------------
| ALBUM DETAIL
|--------------------------------------------------------------------------
*/



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
    ->middleware(['auth', 'role:super-admin|admin|content-maker'])
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | POSTS (BERITA)
        |--------------------------------------------------------------------------
        */

        Route::resource('posts', AdminPostController::class);

        // Publish (Approval)
        Route::post('posts/{post}/publish',
            [AdminPostController::class, 'publish'])
            ->middleware('permission:publish posts')
            ->name('posts.publish');
        Route::post('upload-image',
            [AdminPostController::class, 'uploadImage']
        )->name('upload.image');
        Route::post('posts/autosave', 
            [AdminPostController::class, 'autosave']
        )->name('posts.autosave');
        /*
        |--------------------------------------------------------------------------
        | SLIDERS
        |--------------------------------------------------------------------------
        */

        Route::resource('sliders', SliderController::class);


        /*
        |--------------------------------------------------------------------------
        | GALLERIES
        |--------------------------------------------------------------------------
        */

        

        Route::post('galleries/{photo}/update-title',
            [AdminGalleryController::class, 'updateTitle'])
            ->name('galleries.updateTitle');
        Route::delete('galleries/bulk-delete',
            [AdminGalleryController::class,'bulkDelete'])
            ->name('galleries.bulkDelete');
            
        Route::resource('galleries', AdminGalleryController::class);

        /*
        |--------------------------------------------------------------------------
        | ALBUMS
        |--------------------------------------------------------------------------
        */

        Route::resource('albums', AdminAlbumController::class);

        Route::post('albums/{photo}/set-cover',
            [AdminAlbumController::class, 'setCover'])
            ->name('albums.setCover');
        Route::post('albums/{album}/upload',
            [AdminAlbumController::class, 'uploadPhotos'])
            ->name('albums.upload');

        /*
        |--------------------------------------------------------------------------
        | TEACHERS
        |--------------------------------------------------------------------------
        */

        Route::resource('teachers', AdminTeacherController::class);

    });