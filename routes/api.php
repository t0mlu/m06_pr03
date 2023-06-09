<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\PlatformController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('apartments', ApartmentController::class);
    Route::get('platform/{id}', [ApartmentController::class, 'apartmentsInPlatform']);
    Route::get('apartments_rented', [ApartmentController::class, 'rentedApartments']);
    Route::get('apartments_premium', [ApartmentController::class, 'apartmentsPremium']);
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
