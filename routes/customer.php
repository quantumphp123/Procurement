<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Customer\EnquiryController;
use App\Http\Controllers\Customer\LoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\Customer\ContactUsController;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;


// Public routes (no auth required)
Route::get('customer/login', [LoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('customer/login', [LoginController::class, 'login'])->name('customer.login');
Route::get('customer/register', [RegisterController::class, 'create'])->name('customer.register');
Route::post('customer/register', [RegisterController::class, 'store'])->name('customer.store');



Route::get('/customer', [EnquiryController::class, 'index'])->name('website');

// Protected routes (auth required)
Route::middleware([CustomerMiddleware::class])->prefix('customer')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('customer.logout');
    Route::get('enquiry', [EnquiryController::class, 'create'])->name('customer.enquiry');
    Route::post('enquiry', [EnquiryController::class, 'store'])->name('customer.enquiry.store');
    Route::post('enquiry/items', [EnquiryController::class, 'storeItems'])->name('customer.enquiry.items.store');
    Route::get('enquiry-management', [EnquiryController::class, 'enquiryManagement'])->name('enquiry.management');
    Route::get('my-quotation', [EnquiryController::class, 'myQuotation'])->name('my.quotation');
    Route::get('my-orders', [EnquiryController::class, 'myOrders'])->name('customer.my.orders');
    Route::get('submit-enquiry-form', [EnquiryController::class, 'submitEnquiryForm'])->name('submit.enquiry.form');
    Route::get('view-quotation', [EnquiryController::class, 'viewQuotation'])->name('view.quotation');
    Route::get('plan-selection', [LoginController::class, 'planSelection'])->name('customer.plan.selection');
    Route::post('update-plan', [RegisterController::class, 'updatePlan'])->name('customer.update.plan');
    Route::get('plan-status', [RegisterController::class, 'checkPlanStatus'])->name('customer.plan.status');
    Route::get('customer-details', [RegisterController::class, 'customerDetails'])->name('customer.company.details');
    Route::put('customer-details', [RegisterController::class, 'updateCustomerDetails'])->name('customer.company.details.update');
    Route::get('contact-us', [ContactUsController::class, 'contactUs'])->name('customer.contact.us');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('customer.contact-us.store');
    Route::post('update-profile-image', [RegisterController::class, 'updateProfileImage'])->name('customer.update.profile.image');
});

// Email verification routes
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent!']);
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


