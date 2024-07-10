<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('auth/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->post('auth/token-update', [AuthController::class, 'tokenUpdate']);
Route::get('/unauthenticated', [AuthController::class, 'unauthenticated'])->name('login');

// User Routes
Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('user', [UserController::class, 'show']);
    Route::put('user', [UserController::class, 'update']);
    Route::post('user/change-password', [UserController::class, 'changePassword']);
});

// Social Routes
Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);