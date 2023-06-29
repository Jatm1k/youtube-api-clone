<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


Route::apiResources([
    'categories' => CategoryController::class,
    'channels' => ChannelController::class,
    'videos' => VideoController::class,
]);
