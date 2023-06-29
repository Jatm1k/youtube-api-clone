<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use Illuminate\Support\Facades\Route;


Route::apiResources([
    'categories' => CategoryController::class,
    'channels' => ChannelController::class,
]);
