<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) { */
/*    return $request->user(); */
/* })->middleware('auth:sanctum'); */
/**/

Route::prefix('v1')->group(function () {
    // auth routes
    Route::post('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/register', [AuthController::class, 'store'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('carts', CartController::class);
        Route::apiResource('orders', OrderController::class);

        Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');
    });

});
