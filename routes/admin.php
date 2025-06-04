<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UnitController;
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Home
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Category
    Route::resource('category', CategoryController::class);

    // Password
    Route::get('change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.form');
    Route::post('change-password', [PasswordController::class, 'updatePassword'])->name('password.update');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Units Management Routes
    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');
    Route::patch('/units/{unit}/toggle-status', [UnitController::class, 'toggleStatus'])->name('units.toggle-status');
});
