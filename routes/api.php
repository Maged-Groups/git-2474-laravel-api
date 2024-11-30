<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('users')
    ->group(function () {
        Route::get('trashed', 'trashed');
        Route::put('{id}/restore', 'restore');
        Route::get('role/{role}', 'role');
    });

Route::apiResource('users', UserController::class);

Route::apiResource('posts', PostController::class);
