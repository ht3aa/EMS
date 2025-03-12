<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // auth routes
    Route::post('/login', [UserController::class, 'show'])->name('login');
    Route::post('/register', [UserController::class, 'store'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserController::class, 'destroy'])->name('logout');
    });

});
