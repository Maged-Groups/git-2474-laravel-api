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
        Route::post('register', 'register');
    });


// Protected Routes

Route::middleware(['auth:sanctum', 'verified'])
    ->group(function () {

        // Auth
        Route::controller(AuthController::class)
            ->prefix('auth')
            ->group(function () {
            Route::post('logout', 'logout');
            Route::post('logout-all', 'logout_all');
            Route::post('change-password', 'change_password');
        });

        // Users
        Route::controller(UserController::class)
            ->prefix('users')
            ->group(function () {
            Route::get('trashed', 'trashed')->middleware('roles:hr|admin|moderator');
            Route::put('{id}/restore', 'restore')->middleware('roles:hr|admin');
            Route::get('role/{role}', 'role');
        });

        Route::apiResource('users', UserController::class);

        // posts
        Route::apiResource('posts', PostController::class);

    });
