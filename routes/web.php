<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\FavoriteController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\EventRecommendationController;
use App\Http\Controllers\Home;
use App\Http\Controllers\Home\QuizController;
use App\Http\Controllers\Home\SiteController;
use App\Http\Controllers\Home\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard/home', function () {
    if (auth()->user()->hasRole('company') && auth()->user()->companies->count() < 1) {
        return redirect()->route('dashboard.companies.create');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    if (auth()->user()->hasRole('company') && auth()->user()->companies->count() < 1) {
        return redirect()->route('dashboard.companies.create');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth', 'checkStatus')->group(function () {

    // Display list of bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    // Store a new booking
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    // Update a booking
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    // Display list of notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    // Store a new notification
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');

    // Mark a notification as read
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/updateInfo', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // suggestion
});

Route::middleware(['role:admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Routes accessible only to admins


    Route::get('/statistics', [Dashboard\HomeController::class, 'statistics'])->name('statistics.index');

    Route::resource('users', Dashboard\UserController::class);
    Route::get('/contact', [Dashboard\HomeController::class, 'contact'])->name('contact');
});
// company
Route::middleware(['role:admin||moderator|company', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Routes accessible to admins and coach


    Route::resource('companies', Dashboard\CompanyController::class);
    Route::resource('events', Dashboard\EventController::class);

    Route::resource('payments', Dashboard\PaymentController::class);
    Route::resource('bookings', Dashboard\BookingController::class);
    Route::resource('packages', Dashboard\PackageController::class);
    Route::get('/imageGallery/browser', [Dashboard\ImageGalleryController::class, 'browser'])->name('imageGallery.browser');
    Route::post('/imageGallery/uploader', [Dashboard\ImageGalleryController::class, 'uploader'])->name('imageGallery.uploader');
});

Route::middleware(['role:admin||moderator', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Routes accessible to admins and coach

    Route::resource('categories', Dashboard\CategoryController::class);
    Route::resource('blog_news', Dashboard\BlogNewsController::class);
    Route::resource('comments_ratings', Dashboard\CommentRatingController::class);


    Route::get('/imageGallery/browser', [Dashboard\ImageGalleryController::class, 'browser'])->name('imageGallery.browser');
    Route::post('/imageGallery/uploader', [Dashboard\ImageGalleryController::class, 'uploader'])->name('imageGallery.uploader');


    Route::get('/train-model', [EventRecommendationController::class, 'trainModel'])->name('train.model');
    Route::get('/suggest-events', [EventRecommendationController::class, 'suggestEvents'])->name('suggest.events');
});

Route::middleware(['auth', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {

    // suggestion
});

require __DIR__ . '/auth.php';
