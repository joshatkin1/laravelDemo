<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);

#USER/USERS ROUTES
Route::controller(\App\Http\Controllers\UserController::class)->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', 'index')->name('users');
        Route::get('/create', 'create')->name('users-create');
        Route::post('/', 'store')->name('users-store');
    });

    Route::prefix('user')->group(function () {
        Route::get('/{id}', 'user')->name('user');
        Route::put('/{id}', 'update')->name('user-update');
    });

})->middleware(['auth']);

#POST ROUTES
Route::controller(\App\Http\Controllers\PostController::class)->group(function () {

    Route::prefix('posts')->group(function () {
        Route::get('/', 'index')->name('posts');
        Route::get('/create', 'create')->name('posts-create');
        Route::post('/', 'store')->name('posts-store');
    });

    Route::prefix('post')->group(function () {
        Route::get('/{id}', 'post')->name('post');
        Route::put('/{id}', 'update')->name('user-update');
    });

})->middleware(['auth']);
