<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\VerifyEmailViewResponse;

class CustomVerifyEmailViewResponse implements VerifyEmailViewResponse
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

        // Role based email verification view
        if ($user && $user->role_id == 3) {
            // Seller
            return view('seller.verify-email');
        } else {
            // Admin or default
            return view('auth.verify-email');
        }
    }
}
