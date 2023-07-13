<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'store'])->middleware('guest');
Route::delete('/logout', [AuthController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'store'])->middleware('guest');
Route::delete('/delete-account', [UserController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('auth:sanctum');
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify')
    ->middleware(['auth:sanctum', 'signed']);
