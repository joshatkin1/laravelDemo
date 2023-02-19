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


Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'index')->name('users');
        });

        Route::prefix('user')->group(function () {
            Route::get('/{id}', 'user')->name('user');
        });
    });

    Route::controller(\App\Http\Controllers\PostController::class)->group(function () {

        Route::prefix('posts')->group(function () {
            Route::get('/', 'index')->name('posts');
        });

        Route::prefix('post')->group(function () {
            Route::get('/', 'post')->name('post');
        });
    });


});