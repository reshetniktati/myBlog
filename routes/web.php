<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::post('/', [PostController::class, 'store']);
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::prefix('/{post}')->group(function() {
        Route::get('/', [PostController::class, 'show'])->name('posts.show');
        Route::put('/', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/edit', [PostController::class, 'edit'])->name('posts.edit');

        Route::get('/subscribe', [SubscriptionController::class, 'index'])->name('subscribe.index');
        Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('posts.subscribe');
    });
});

Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
});

