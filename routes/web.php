<?php

use App\Http\Controllers\PostController;
use App\Http\controllers\WelcomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::post('/', [PostController::class, 'store']);
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::put('/{id}', [PostController::class, 'update']);
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
});
