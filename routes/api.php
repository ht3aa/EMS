<?php

use App\Http\Controllers\AuthController;
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
        Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');
    });

});
