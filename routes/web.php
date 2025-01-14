<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controllers you referenced:
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthFailedController;

// NEW: BookDetailsController for the popup data
use App\Http\Controllers\BookDetailsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'     => Route::has('login'),
        'canRegister'  => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'   => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // HOME
    Route::redirect('/', '/home', 301);
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::post('/home/post', [PostController::class, 'store']);
    Route::delete('/home/post/{id}', [PostController::class, 'destroy']);

    // EMAIL
    Route::get('/email', [EmailController::class, 'index'])->name('email');

    // CALENDAR
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::post('/calendar/event', [CalendarController::class, 'store']);
    Route::delete('/calendar/event/{id}', [CalendarController::class, 'destroy']);
    Route::put('/calendar/event/{id}', [CalendarController::class, 'update']);

    // REPORTS
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');

    // USERS
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users', [UsersController::class, 'store']);
    Route::post('/users/upload-excel', [UsersController::class, 'uploadExcel']);
    Route::put('/users/{userId}', [UsersController::class, 'updateStatus']);
    Route::delete('/users/{userId}', [UsersController::class, 'deleteUser']);

    // ABOUT
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // HELP
    Route::get('/help', [HelpController::class, 'index'])->name('help');
    Route::post('/help/faq', [HelpController::class, 'store']);
    Route::delete('/help/faq/{id}', [HelpController::class, 'destroy']);

    // RESOURCES
    Route::get('/resources', [ResourcesController::class, 'index'])->name('resources');
    Route::post('/resources', [ResourcesController::class, 'store']);
    // Route for top 3 most-read
    Route::get('/api/resources/most-read', [ResourcesController::class, 'mostReadBooks']);

    // BOOKS
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books', [BookController::class, 'index']);

    // NEW: Book details for popup
    Route::get('/api/book-details/{resourceId}', [BookDetailsController::class, 'show']);

});

Route::get('/auth-failed', [AuthFailedController::class, 'index'])->name('auth-failed');
