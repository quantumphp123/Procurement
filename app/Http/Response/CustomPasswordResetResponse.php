<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\PasswordResetResponse as PasswordResetResponseContract;

class CustomPasswordResetResponse implements PasswordResetResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => 'Your password has been reset successfully!'], 200)
            : redirect()->route('seller.login')->with('success', 'Your password has been reset successfully! Please login with your new password.');
    }
}
