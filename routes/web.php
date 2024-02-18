<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register_form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login_form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.single');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.single');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.single');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    Route::resource('/users', AdminUserController::class)->except(['create', 'store', 'show']);
    Route::resource('/categories', AdminCategoryController::class)->except(['show']);
    Route::resource('/tags', AdminTagController::class)->except(['show']);
    Route::resource('/posts', AdminPostController::class)->except(['show']);
});
