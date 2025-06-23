<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    // Define full resource routes for all models
    Route::resource('courses', CourseController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);

    // For reviews, we'll nest them under courses for creation
    Route::post('courses/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

