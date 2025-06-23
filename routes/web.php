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

// Define full resource routes for all models
Route::resource('courses', CourseController::class);
Route::resource('authors', AuthorController::class);
Route::resource('categories', CategoryController::class);

// For reviews, we'll nest them under courses for creation
Route::post('courses/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store')
    ->middleware('auth');
Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
