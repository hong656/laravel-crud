<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::resource('courses', CourseController::class);

Route::get('/', function () {
    return view('welcome');
});
