<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Display the login page
    public function showLogin()
    {
        return Inertia::render('Auth/Login');
    }

    // Redirect to Google OAuth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google OAuth callback
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find or create the user in the database
        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'role' => $googleUser->getEmail() === 'admin@example.com' ? 'admin' : 'sub-admin', // Set your own logic here
            ]
        );

        // Log the user in
        Auth::login($user);

        // Redirect based on the user role
        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'subadmin.dashboard');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
