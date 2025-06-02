<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/**
 * Main Application Routes
 */

// Default welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (login, register, reset password)
Auth::routes();

/**
 * Email Verification Routes
 * ------------------------------------
 * These routes handle the email verification process.
 */

/**
 * Seller Routes
 * ------------------------------------
 * Routes specific to sellers with email verification functionality
 */

// TODO:: Need to remove this routes
Route::prefix('seller')->group(function () {
    // Show email verification notice page - requires auth
    Route::get('/email/verify', function () {
        return view('seller.verify-email');
    })->middleware('auth')->name('verification.notice');

    // Handle the actual verification - middleware applied here only
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        // After successful verification, redirect based on user type
        $user = $request->user();
        if ($user->role_id == 3) {
            return redirect('/seller/register/step-2')->with('success', 'Email verified successfully!');
        } else {
            return redirect('/home')->with('success', 'Email verified successfully!');
        }
    })->middleware(['signed', \App\Http\Middleware\EmailVerificationRedirect::class])->name('verification.verify');

    // Resend verification email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

/**
 * Admin Routes
 * ------------------------------------
 * Routes for admin panel functionality with authentication middleware
 */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard route (currently commented out)
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Category management
    Route::resource('category', CategoryController::class);

    // Password management
    Route::get('change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.form');
    Route::post('change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
});
