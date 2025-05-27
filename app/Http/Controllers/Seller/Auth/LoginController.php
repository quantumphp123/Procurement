<?php

namespace App\Http\Controllers\Seller\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\LoginRequest;

class LoginController extends Controller
{
    /**
     * Show the login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('seller.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \App\Http\Requests\Seller\LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            // Attempt to authenticate the user
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                // Regenerate session for security
                $request->session()->regenerate();
                // Return success response
                return redirect()->route('seller.dashboard')->with('success', 'Login successful!');
            }

            // Authentication failed
            return redirect()->back()->with('error', 'These credentials do not match our records.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();

            // Regenerate the CSRF token
            $request->session()->regenerateToken();

            return redirect()->route('seller.login')->with('success', 'You have been logged out successfully.');
        } catch (\Exception $e) {
            return redirect()->route('seller.login')->with('error', 'An error occurred during logout. Please try again.');
        }
    }
}
