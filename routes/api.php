<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::apiResource('movies', \App\Http\Controllers\MovieController::class);
});
