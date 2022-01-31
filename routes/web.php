<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');


Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::prefix('posts')->group(function () {
    Route::get('create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('store', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
});
