<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\GlobalPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', GlobalPostController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('/posts', PostController::class)
        ->except('index');

    Route::controller(AvatarController::class)->group(function () {
        Route::patch('avatar/update', 'update')->name('profile.avatar.update');
        Route::delete('avatar/delete', 'destroy')->name('profile.avatar.delete');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{user:username}', 'index')->name('profile.index');
        Route::get('/profile/{user:username}/edit', 'edit')->name('profile.edit');
        Route::put('/profile/{user}', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
