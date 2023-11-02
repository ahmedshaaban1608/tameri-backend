<?php

use App\Http\Controllers\api\AreaController;
use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\api\LanguageController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\TourguideController;
use App\Http\Controllers\api\TouristController;
use App\Http\Controllers\api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('users', UserController::class);
Route::apiResource('users', UserController::class)->except(['create', 'edit']);

Route::apiResource('tourists', TouristController::class);
Route::apiResource('tourguides', TourguideController::class);
Route::apiResource('languages', LanguageController::class);
Route::apiResource('areas', AreaController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('reports', ReportController::class);


Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('logout', [AuthController::class, 'logout']);

Route::get('/showUsers', [App\Http\Controllers\AdminController::class, 'getUsers']);

<<<<<<< HEAD
=======


Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
>>>>>>> 8e24e4c (complete authorization- to be continue...{)
