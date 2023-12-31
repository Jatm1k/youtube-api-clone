<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


Route::apiResources([
    'categories' => CategoryController::class,
    'channels' => ChannelController::class,
    'videos' => VideoController::class,
    'users' => UserController::class,
    'playlists' => PlaylistController::class,
    'comments' => CommentController::class,
]);

Route::apiResource('users', UserController::class)->except(['store', 'destroy']);

Route::get('/profile', [UserController::class, 'showProfile']);
Route::put('/profile', [UserController::class, 'updateProfile']);
