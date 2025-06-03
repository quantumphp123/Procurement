<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\PasswordResetResponse;

class CustomPasswordResetResponse implements PasswordResetResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // Role based redirect after password reset
        if ($user && $user->role_id == 3) {
            // Seller
            return redirect()->route('seller.login')->with('status', 'Password reset successfully!');
        } else {
            // Admin or default
            return redirect()->route('login')->with('status', 'Password reset successfully!');
        }
    }
}
