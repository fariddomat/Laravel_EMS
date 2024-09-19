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
        // Get all favorites for the authenticated user
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

        // Add a new favorite
        Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');

        // Show a specific favorite (optional, if you need to view a specific favorite)
        Route::get('/favorites/{favorite}', [FavoriteController::class, 'show'])->name('favorites.show');

        // Update a favorite (if needed)
        Route::put('/favorites/{favorite}', [FavoriteController::class, 'update'])->name('favorites.update');

        // Remove a favorite
        Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');


    // Notification routes
    Route::apiResource('notifications', NotificationController::class);

    // CommentRating routes
    Route::apiResource('comments-ratings', CommentRatingController::class);
    Route::post('/comments', [CommentRatingController::class, 'store']);  // Store comment
    Route::delete('/comments/{id}', [CommentRatingController::class, 'destroy']);  // Delete comment
    // Route::apiResource('events', EventController::class);

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
