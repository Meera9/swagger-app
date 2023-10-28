<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;


Route::post('sign/in', [LoginController::class, 'login']);

Route::group([
    'middleware' => [
        'auth:api',
    ],
], function () {
    Route::apiResource('blogs', BlogController::class)->except(['edit', 'create']);
});
