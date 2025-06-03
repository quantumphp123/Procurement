<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Main Application Routes
 */

// Default welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (login, register, reset password)
Auth::routes();

require __DIR__ . '/admin.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/seller.php';
