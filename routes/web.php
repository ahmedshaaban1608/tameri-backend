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

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/users', [AdminController::class, 'showUsers'])->name('users');
Route::get('/tourists', [AdminController::class, 'showTourists'])->name('tourists');
Route::get('/order', [AdminController::class, 'showOrders'])->name('orders');
Route::get('/reviews', [AdminController::class, 'showReviews'])->name('reviews');
Route::get('/tourguides', [AdminController::class, 'showTourguides'])->name('tourguides');
Route::delete('/tourists/{id}', [TouristController::class, 'destroy'])->name('tourists.destroy');
Route::put('/tourists/{id}', [TouristController::class, 'update'])->name('tourists.update');
Route::get('/tourists/{id}/edit', [TouristController::class, 'edit'])->name('tourists.edit');
Route::get('/tourists/{id}', [TouristController::class, 'showTourist'])->name('tourists.showTourist');
// Route::delete('/tourists/{tourist}', [TouristController::class, 'destroy'])->name('tourists.destroy');

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/tourguides/{id}', [TourguideController::class, 'show'])->name('tourguides.show');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');


// Route::get('/tourists', function () {
//     return view('Dashboard.tourists');
// })->name('tourists');