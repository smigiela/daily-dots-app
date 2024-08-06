<?php

use App\Http\Controllers\Diary\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// diary context
Route::prefix('diary')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::resource('tasks', TaskController::class);

    });

require __DIR__.'/auth.php';
