<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Display the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Show the login page
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Google SSO routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    // Admin dashboard route
    Route::get('/admin/dashboard', function () {
        return inertia('Admin/Dashboard');
    })->name('admin.dashboard');

    // Sub-admin dashboard route
    Route::get('/subadmin/dashboard', function () {
        return inertia('SubAdmin/Dashboard');
    })->name('subadmin.dashboard');
});
