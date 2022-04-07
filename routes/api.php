<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::apiResource('categories', \App\Http\Controllers\CategoryController::class)->only(['index', 'show']);
Route::get('categories/{category}/movies', [\App\Http\Controllers\MovieController::class, 'index']);
Route::apiResource('movies', \App\Http\Controllers\MovieController::class)->only(['index', 'show']);
Route::apiResource('actors', \App\Http\Controllers\ActorController::class)->only(['index', 'show']);

// Private routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class)->except(['index', 'show']);;
    Route::apiResource('movies', \App\Http\Controllers\MovieController::class)->except(['index', 'show']);
    Route::apiResource('actors', \App\Http\Controllers\ActorController::class)->except(['index', 'show']);
});
