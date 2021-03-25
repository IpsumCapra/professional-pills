<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::view('/', 'home')->name('home');

// Normal routes
Route::middleware('auth')->group(function () {

});

// Admin routes
Route::middleware('admin')->group(function () {

});

// Guest routes
Route::middleware('guest')->group(function () {
    // Auth login
    Route::view('/auth/login', 'auth.login')->name('auth.login');
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Auth register
    Route::view('/auth/register', 'auth.register')->name('auth.register');
    Route::post('/auth/register', [AuthController::class, 'register']);
});
