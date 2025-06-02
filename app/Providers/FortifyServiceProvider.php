<?php

namespace App\Providers;

use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\CustomPasswordResetResponse;
use App\Http\Responses\CustomVerifyEmailViewResponse;
use Laravel\Fortify\Contracts\PasswordResetResponse;
use Laravel\Fortify\Contracts\VerifyEmailViewResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot()
    {
        // Fortify views
        Fortify::requestPasswordResetLinkView(function () {
            return view('seller.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('seller.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('seller.verify-email');
        });


        $this->app->singleton(
            VerifyEmailViewResponse::class,
            CustomVerifyEmailViewResponse::class
        );

        $this->app->singleton(
            PasswordResetResponse::class,
            CustomPasswordResetResponse::class
        );
    }
}
