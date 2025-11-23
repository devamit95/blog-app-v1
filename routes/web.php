<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::middleware(['audit'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::resource('comments', CommentController::class)->only(['edit','update','destroy']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin','audit'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('posts', AdminPostController::class);
    Route::post('posts/{id}/restore', [AdminPostController::class, 'restore'])->name('posts.restore');
});


Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Social login routes
Route::get('login/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('login/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');


require __DIR__.'/auth.php';
