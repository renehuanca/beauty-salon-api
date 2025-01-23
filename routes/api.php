<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/services', [ServicesController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/users/me', [UserController::class, 'show']);
  Route::put('/users', [UserController::class, 'update']);
  Route::delete('/users', [UserController::class, 'destroy']);

  Route::post('/reservations', [ReservationController::class, 'store']);
  Route::get('/customers/{id}/reservations', [ReservationController::class, 'index']);
  Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);
});
