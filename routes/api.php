<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Courses
Route::apiResource('courses', CourseController::class);
