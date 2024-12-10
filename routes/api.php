<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Unprotected Routes
// Auth
Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'login');
    });


// Protected Routes

Route::middleware(['auth:sanctum', 'roles'])
    ->group(function () {
        // Users
        Route::controller(UserController::class)
            ->prefix('users')
            ->group(function () {
            Route::get('trashed', 'trashed');
            Route::put('{id}/restore', 'restore');
            Route::get('role/{role}', 'role');
        });

        Route::apiResource('users', UserController::class);

        // posts
        Route::apiResource('posts', PostController::class);

    });
