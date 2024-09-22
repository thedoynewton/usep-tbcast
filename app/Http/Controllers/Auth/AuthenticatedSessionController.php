<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);
    
        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();
    
        // Check if user exists
        if ($user) {
            // Log in the user
            Auth::login($user);
    
            // Regenerate the session
            $request->session()->regenerate();
    
            // Always redirect to /dashboard after login
            return redirect()->intended(route('dashboard'));
        }
    
        // If email doesn't exist, return an error
        return back()->withErrors([
            'email' => 'The provided email does not exist in our records.',
        ]);
    }
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
