<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Models\Post;
use App\Models\Slider;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\TeacherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/berita', [PostController::class, 'allNews'])->name('posts.all');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/galeri/{id}', [GalleryPageController::class,'show'])
    ->name('gallery.show');

Route::get('/album/{album}', [\App\Http\Controllers\HomeController::class, 'showAlbum'])
    ->name('album.show');
	
Route::get('/cek-role', function(){
    return auth()->user()->getRoleNames();
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', RoleMiddleware::class.':admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('posts', App\Http\Controllers\PostController::class);
        Route::post('posts/{post}/publish', [PostController::class, 'publish'])
			->name('posts.publish')
			->middleware('role:admin');
		Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);
        Route::resource('galleries', GalleryController::class); 
		Route::resource('albums', \App\Http\Controllers\Admin\AlbumController::class);
        Route::post('albums/{album}/upload',[\App\Http\Controllers\Admin\AlbumController::class, 'uploadPhotos'])->name('albums.upload');
        Route::post('/admin/albums/set-cover/{photo}', [AlbumController::class, 'setCover'])
			->name('albums.setCover')
			->middleware('role:admin');
		Route::post('/gallery/{photo}/update-title', [App\Http\Controllers\Admin\GalleryController::class, 'updateTitle'])
			->name('gallery.updateTitle');
	    Route::resource('teachers', TeacherController::class);
		Route::post('/admin/gallery/{photo}/update-title',
			[App\Http\Controllers\Admin\GalleryController::class, 'updateTitle'])->name('gallery.updateTitle');
		Route::post('/admin/teachers/check-position',
			[TeacherController::class, 'checkPosition']
			)->name('teachers.checkPosition');


});

Route::get('/berita/{slug}', function($slug){
    $post = \App\Models\Post::where('slug',$slug)->firstOrFail();
    return view('posts.show', compact('post'));
})->name('post.show');

// Halaman daftar semua berita (frontend)

require __DIR__.'/auth.php';
