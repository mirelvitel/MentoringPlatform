<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// New route for fetching resources based on topic or search term
Route::get('/resources', [ResourceController::class, 'index']);
