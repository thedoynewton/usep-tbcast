<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Set the login page as the default welcome page
Route::get('/', function () {
    return Inertia::render('Auth/Login'); // Render the Login page instead of the Welcome page
})->name('login');

// Unified Dashboard Route - No separate admin/subadmin dashboards
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'role' => Auth::user()->role, // Pass the user's role to the Dashboard component
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Keep any other role-specific routes protected by CheckRole middleware
// Example: Admin-only settings route
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/settings', function () {
        return Inertia::render('Admin/Settings'); // Admin-specific page example
    })->name('admin.settings');
});

// Profile Routes (accessible to any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Access Denied Route
Route::get('/access-denied', function () {
    return Inertia::render('AccessDenied'); // Create a simple AccessDenied page
})->name('access.denied');

require __DIR__.'/auth.php';
