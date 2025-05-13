<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\HomeController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Home
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Category
    Route::resource('category', CategoryController::class);
    // Password
    Route::get('change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.form');
    Route::post('change-password', [PasswordController::class, 'updatePassword'])->name('password.update');

});




