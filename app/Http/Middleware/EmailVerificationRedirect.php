<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if this is email verification route
        if ($request->route() && $request->route()->getName() === 'verification.verify') {
            $userId = $request->route('id');
            if ($userId) {
                $user = User::find($userId);

                if ($user) {
                    // Check if user is already logged in
                    if (Auth::check()) {
                        // User is logged in, continue with verification
                        return $next($request);
                    } else {
                        // User is not logged in, determine redirect based on role
                        if ($user->role_id == 3) {
                            // Seller - redirect to seller login
                            return redirect('/seller/login')->with([
                                'message' => 'Please login first to verify your email.',
                                'email' => $user->email,
                                'user_type' => 'seller'
                            ]);
                        } else {
                            // Regular user - redirect to normal login
                            return redirect()->route('login')->with([
                                'message' => 'Please login first to verify your email.',
                                'email' => $user->email,
                            ]);
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}
