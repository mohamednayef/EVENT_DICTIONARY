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

Route::middleware(['auth:sanctum','IsAdmin'])->group(function() {
    Route::apiResources([
        'users' => UserController::class,
        'events' => EventController::class,
        'payments' => PaymentController::class,
        'reviews' => ReviewController::class,
        'bookmarks' => BookmarkController::class,
        'tickets' => TicketController::class,
    ]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
