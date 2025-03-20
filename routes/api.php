<?php

use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\BookmarkController;
use App\Http\Controllers\Api\Admin\TicketController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function() {
    return '<h1 align="center">welcome in api</h1>';
});

// Admin only routes
Route::middleware(['auth:sanctum','IsAdmin'])->group(function() {
    Route::apiResources([
        'users' => UserController::class,   // Manage users (Admin only)
        'events' => EventController::class, // Admin manages events
        'payments' => PaymentController::class, // Admin manages payments
        'tickets' => TicketController::class, // Admin manages tickets
    ]);
});

// Routes for Authenticated Users
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/events', [EventController::class, 'index']); // View events
    Route::post('/bookmarks', [BookmarkController::class, 'store']); // Add bookmark
    Route::get('/bookmarks', [BookmarkController::class, 'index']); // View bookmarks
    Route::post('/reviews', [ReviewController::class, 'store']); // Submit reviews
    Route::post('/tickets', [TicketController::class, 'store']); // Buy tickets
    Route::get('/tickets', [TicketController::class, 'index']); // View tickets
    Route::post('/payments', [PaymentController::class, 'store']); // Make payments
});

// Route::middleware(['auth:sanctum','IsAdmin'])->group(function() {
//     Route::apiResources([
//         'users' => UserController::class,
//         'events' => EventController::class,
//         'payments' => PaymentController::class,
//         'reviews' => ReviewController::class,
//         'bookmarks' => BookmarkController::class,
//         'tickets' => TicketController::class,
//     ]);
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
