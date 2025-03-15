<?php

use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\BookmarkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return '<h1 align="center">welcome in api</h1>';
});

Route::prefix('admin')->group(function() {
    Route::apiResources([
        'users' => UserController::class,
        'events' => EventController::class,
        'payments' => PaymentController::class,
        'reviews' => ReviewController::class,
        'bookmarks' => BookmarkController::class,
    ]);
});

