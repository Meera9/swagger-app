<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [
        'auth:api',
    ],
], function () {
    Route::apiResource('products', ProductController::class);
});
