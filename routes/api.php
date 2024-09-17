<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CommentRatingController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\NotificationController;

Route::middleware('auth:sanctum')->group(function () {
    // Authenticated routes
    // User routes
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);

    Route::apiResource('payments', PaymentController::class);

    // Booking routes
    Route::apiResource('bookings', BookingController::class);

    // Favorite routes
    Route::apiResource('favorites', FavoriteController::class);

    // Notification routes
    Route::apiResource('notifications', NotificationController::class);

    // CommentRating routes
    Route::apiResource('comments-ratings', CommentRatingController::class);
});

// Company routes
Route::apiResource('companies', CompanyController::class);

// Event routes
Route::apiResource('events', EventController::class);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
