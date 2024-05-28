<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // HOME
    Route::redirect('/', '/home', 301);
    //Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::post('/home/post', [\App\Http\Controllers\PostController::class, 'store']);

    Route::get('/email', [\App\Http\Controllers\EmailController::class, 'index'])->name('email');
    Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('/reports', [\App\Http\Controllers\ReportsController::class, 'index'])->name('reports');

    // USERS
    Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::post('/users', [\App\Http\Controllers\UsersController::class, 'store']);

    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

    // HELP
    Route::get('/help', [\App\Http\Controllers\HelpController::class, 'index'])->name('help');
    Route::post('/help/faq', [\App\Http\Controllers\HelpController::class, 'store']);
    Route::delete('/help/faq/{id}', [\App\Http\Controllers\HelpController::class, 'destroy']);
});

Route::get('/auth-failed', [\App\Http\Controllers\AuthFailedController::class, 'index'])->name('auth-failed');
