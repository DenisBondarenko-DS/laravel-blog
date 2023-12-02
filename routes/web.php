<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    Route::resource('/categories', AdminCategoryController::class)->except(['show']);
    Route::resource('/tags', AdminTagController::class)->except(['show']);
    Route::resource('/posts', AdminPostController::class)->except(['show']);
});
