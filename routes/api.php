<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Courses
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('courses', CourseController::class);
});

// Auth
Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('guest')
        ->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('guest')
        ->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user'])->name('user');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
