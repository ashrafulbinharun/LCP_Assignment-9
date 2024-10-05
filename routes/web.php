<?php

use App\Http\Controllers\GlobalPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', GlobalPostController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('/posts', PostController::class)
        ->except('index');

    Route::get('/profile/{user:username}', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::get('/profile/{user:username}/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
