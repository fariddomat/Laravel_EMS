<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\FavoriteController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\UserController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/pusher/auth', function () {
    return Auth::user();
});

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/categories', [SiteController::class, 'categories'])->name('categories');
Route::get('/categories/{category}', [SiteController::class, 'properties'])->name('properties');
Route::get('/property/{property}', [SiteController::class, 'property'])->name('property');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'sendContact'])->name('sendContact');
Route::get('/search', [SiteController::class, 'search'])->name('search');

Route::get('/about', [SiteController::class, 'about'])->name('about');


// Ensure that the user is authenticated for these routes
Route::middleware(['auth', 'checkStatus'])->group(function () {



    Route::get('/property/{property}/order', [SiteController::class, 'orderForm'])->name('order.form');
    Route::post('/property/{property}/order', [SiteController::class, 'processOrder'])->name('order.process');
    Route::get('/checkout', [SiteController::class, 'checkout'])->name('checkout');

    Route::post('/property/{property}/favorite', [SiteController::class, 'addToFavorite'])->name('addToFavorite');
    Route::post('/property/{property}/comment', [SiteController::class, 'comment'])->name('comment');
});

Route::middleware('auth', 'checkStatus')->group(function () {

    // Display list of bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    // Store a new booking
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    // Update a booking
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/updateInfo', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/orders/user', [OrderController::class, 'indexUser'])->name('orders.user');

    // suggestion
});
Route::middleware(['role:admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Routes accessible only to admins


    Route::get('/statistics', [Dashboard\HomeController::class, 'statistics'])->name('statistics.index');

    Route::resource('users', Dashboard\UserController::class);
    Route::get('/contact', [Dashboard\HomeController::class, 'contact'])->name('contact');
});
// owner
Route::middleware(['role:admin||moderator|owner', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Routes accessible to admins and coach

    Route::resource('properties', Dashboard\PropertyController::class);
    Route::resource('properties/{property}/image', Dashboard\PropertyImageController::class)->except(['show', 'edit', 'update']);

    Route::get('/orders/admin', [OrderController::class, 'indexAdmin'])->name('orders.admin');
    Route::get('/orders/owner', [OrderController::class, 'indexOwner'])->name('orders.owner');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

    Route::resource('comments', Dashboard\CommentController::class);



    Route::get('/imageGallery/browser', [Dashboard\ImageGalleryController::class, 'browser'])->name('imageGallery.browser');
    Route::post('/imageGallery/uploader', [Dashboard\ImageGalleryController::class, 'uploader'])->name('imageGallery.uploader');
});

Route::middleware(['role:admin||moderator', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Routes accessible to admins and coach

    Route::resource('categories', Dashboard\CategoryController::class);
    Route::resource('companies', Dashboard\CompanyController::class);
    Route::resource('events', Dashboard\EventController::class);


    Route::get('/imageGallery/browser', [Dashboard\ImageGalleryController::class, 'browser'])->name('imageGallery.browser');
    Route::post('/imageGallery/uploader', [Dashboard\ImageGalleryController::class, 'uploader'])->name('imageGallery.uploader');
});

Route::middleware(['auth', 'checkStatus'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // suggestion
});

require __DIR__ . '/auth.php';
