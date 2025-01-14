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
    Route::get('/home', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::post('/home/post', [\App\Http\Controllers\PostController::class, 'store']);
    Route::delete('/home/post/{id}', [\App\Http\Controllers\PostController::class, 'destroy']);

    // EMAIL
    Route::get('/email', [\App\Http\Controllers\EmailController::class, 'index'])->name('email');

    // CALENDAR
    Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::post('/calendar/event', [\App\Http\Controllers\CalendarController::class, 'store']);
    Route::delete('/calendar/event/{id}', [\App\Http\Controllers\CalendarController::class, 'destroy']);
    Route::put('/calendar/event/{id}', [\App\Http\Controllers\CalendarController::class, 'update']);

    // REPORTS
    Route::get('/reports', [\App\Http\Controllers\ReportsController::class, 'index'])->name('reports');

    // USERS
    Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index'])->name('users');
    Route::post('/users', [\App\Http\Controllers\UsersController::class, 'store']);
    Route::post('/users/upload-excel', [\App\Http\Controllers\UsersController::class, 'uploadExcel']);
    Route::put('/users/{userId}', [\App\Http\Controllers\UsersController::class, 'updateStatus']);
    Route::delete('/users/{userId}', [\App\Http\Controllers\UsersController::class, 'deleteUser']);

    // ABOUT
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

    // HELP
    Route::get('/help', [\App\Http\Controllers\HelpController::class, 'index'])->name('help');
    Route::post('/help/faq', [\App\Http\Controllers\HelpController::class, 'store']);
    Route::delete('/help/faq/{id}', [\App\Http\Controllers\HelpController::class, 'destroy']);

    // RESOURCES
    Route::get('/resources', [\App\Http\Controllers\ResourcesController::class, 'index'])->name('resources');
    Route::post('/resources', [\App\Http\Controllers\ResourcesController::class, 'store']);

    // Books
    Route::post('/books', [\App\Http\Controllers\BookController::class, 'store']);
    Route::get('/books', [\App\Http\Controllers\BookController::class, 'index']);

});

// Add a route for fetching the top-three most-read books
Route::get('/api/resources/most-read', [\App\Http\Controllers\ResourcesController::class, 'mostReadBooks']);

Route::get('/auth-failed', [\App\Http\Controllers\AuthFailedController::class, 'index'])->name('auth-failed');
