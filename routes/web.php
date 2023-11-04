<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourguideController;
use App\Http\Controllers\TouristController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::resource('tourists', TouristController::class);
Route::resource('tourguides', TourguideController::class);
Route::resource('orders', OrderController::class);
Route::resource('reports', ReportController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('areas', AreaController::class);
Route::resource('languages', LanguageController::class);
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/tourists', [AdminController::class, 'showTourists'])->name('tourists');
Route::delete('/tourists/{id}', [TouristController::class, 'destroy'])->name('tourists.destroy');
Route::get('/tourists/{id}', [TouristController::class, 'show'])->name('tourists.show');
Route::put('/tourists/{id}', [TouristController::class, 'update'])->name('tourists.update');

Route::get('/tourguides', [AdminController::class, 'showTourguides'])->name('tourguides');
Route::get('/tourguides/{id}', [TourguideController::class, 'show'])->name('tourguides.show');
Route::put('/tourguides/{id}', [TourguideController::class, 'update'])->name('tourguides.update');

Route::get('/reviews', [AdminController::class, 'showReviews'])->name('reviews');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');

Route::get('/order', [AdminController::class, 'showOrders'])->name('orders');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

Route::get('/users', [AdminController::class, 'showUsers'])->name('users');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');



// Route::resource('tourguides', TourguideController::class)->except(['show', 'update']);

// Route::get('/tourists', function () {
//     return view('Dashboard.tourists');
// })->name('tourists');