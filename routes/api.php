<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Auth
Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'login');
    });




Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)
        ->prefix('users')
        ->group(function () {
            Route::get('trashed', 'trashed');
            Route::put('{id}/restore', 'restore');
            Route::get('role/{role}', 'role');
        });

    Route::apiResource('users', UserController::class);

    Route::apiResource('posts', PostController::class);

});


