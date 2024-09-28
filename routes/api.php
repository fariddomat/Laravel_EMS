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
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CommentRatingController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\EventRecommendationController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\SuggestionController;

Route::get('/event-suggestions', [EventRecommendationController::class, 'suggestEvents']);

Route::middleware('auth:sanctum')->group(function () {
    // Authenticated routes
    // User routes
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);

    Route::get('/user-payments', [PaymentController::class, 'getUserPayments']);

    // Booking routes

    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/user-bookings', [BookingController::class, 'userBookings']);
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancelBooking']);
    Route::post('book-package', [BookingController::class, 'bookPackage']);



    Route::post('/train-model', [EventRecommendationController::class, 'trainModel']);

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

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::get('/notifications/count', [NotificationController::class, 'count']);


    // CommentRating routes
    Route::apiResource('comments-ratings', CommentRatingController::class);
    Route::post('/comments', [CommentRatingController::class, 'store']);  // Store comment
    Route::delete('/comments/{id}', [CommentRatingController::class, 'destroy']);  // Delete comment
    // Route::apiResource('events', EventController::class);

});

// Company routes
Route::apiResource('companies', CompanyController::class);
// Get a single company with its events

// Get events for a specific company
Route::get('/companies/{id}/events', [EventController::class, 'getEventsByCompany']);

// Event routes
Route::apiResource('events', EventController::class);
Route::get('/home-events', [EventController::class, 'getHomeEvents']);
// Route::get('/events-page', [EventController::class, 'getPaginatedEvents']);

Route::get('/events-page', [EventController::class, 'getEvents']);
Route::get('/categories', [EventController::class, 'getCategories']);


Route::get('/packages', [PackageController::class, 'index']);
Route::post('/packages', [PackageController::class, 'store']);
Route::get('/packages/{id}', [PackageController::class, 'show']);
Route::put('/packages/{id}', [PackageController::class, 'update']);
Route::delete('/packages/{id}', [PackageController::class, 'destroy']);


Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);

Route::post('/contacts', [ContactController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
