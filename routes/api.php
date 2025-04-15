<?php

use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\BookmarkController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\TicketController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return '<h1 align="center">welcome in api</h1>';
});



// Routes for Authenticated Users
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/events', [EventController::class, 'index']); // View events
    Route::get('/events/{id}', [EventController::class, 'show']); // View specific event

    Route::post('/bookmarks', [BookmarkController::class, 'store']); // Add bookmark
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy']); // delete bookmarks
    Route::get('/mybookmarks', [BookmarkController::class, 'mybookmarks']);

    Route::post('/reviews', [ReviewController::class, 'store']); // Submit reviews

    Route::get('/tickets/{id}', [TicketController::class, 'show']); // Show specific ticket
    Route::get('/mytickets', [TicketController::class, 'mytickets']);
    
    Route::post('/payments', [PaymentController::class, 'store']); // Make payments
    Route::get('/mypayments', [PaymentController::class, 'mypayments']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    Route::post('/charge', [PaymentController::class, 'charge']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/profile', [UserController::class, 'updateMyProfile']);
    Route::delete('/profile', [UserController::class, 'deleteMyProfile']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Admin only routes
Route::middleware(['auth:sanctum','IsAdmin'])->group(function() {
    Route::apiResources([
        'users' => UserController::class,   // Manage users (Admin only)
        'events' => EventController::class, // Admin manages events
        'payments' => PaymentController::class, // Admin manages payments
        'tickets' => TicketController::class, // Admin manages tickets
        'categories' => CategoryController::class,
        'bookmarks' => BookmarkController::class,
    ]);
});