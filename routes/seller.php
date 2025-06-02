<?php


use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\EnquiryController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\Auth\AuthController;
use App\Http\Controllers\Seller\Auth\LoginController;
use App\Http\Controllers\Seller\ModifiedOrdersController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| All public routes that don't require authentication to access
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Registration Routes - Step 1
|--------------------------------------------------------------------------
|
| Routes related to the first step of registration (no authentication required)
|
*/


// Registration Routes - Step 1
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Forgot Password Routes
|--------------------------------------------------------------------------
|
| Routes related to the first step of registration (no authentication required)
|
*/

// Show the forgot password form
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

// Submit the forgot password form (send reset link email)
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// Show the reset password form (when user clicks the email link)
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

// Submit the new password (complete the password reset)
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');



/*
|--------------------------------------------------------------------------
| Registration Routes - Step 2 and 3 (Protected)
|--------------------------------------------------------------------------
|
| Routes related to the second and third steps of registration (requires authentication)
| User must be logged in to access these routes
|
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Step 2 Registration Routes
    Route::get('/register/step-2', [AuthController::class, 'showStepTwoForm'])->name('register.step2.form');
    Route::post('/register/step-2', [AuthController::class, 'processStepTwo'])->name('register.step2');

    // Step 3 Registration Routes
    Route::get('/register/step-3', [AuthController::class, 'showStepThreeForm'])->name('register.step3.form');
    Route::post('/register/step-3', [AuthController::class, 'processStepThree'])->name('register.step3');

    // Step 4 Plans Routes
    Route::get('/register/plans', [AuthController::class, 'showPlans'])->name('register.plans');


    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Enquiries Routes
    |--------------------------------------------------------------------------
    |
    | User must be logged in to access these routes
    |
    */

    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{id}', [EnquiryController::class, 'show'])->name('enquiries.show');
    Route::post('/submit-quotation/{id}', [EnquiryController::class, 'submitQuotation'])->name('enquiries.submit-quotation');
    Route::post('enquiries/{enquiry}/decline', [EnquiryController::class, 'declineEnquiry'])->name('enquiries.decline');

    /*
    |--------------------------------------------------------------------------
    | Products Routes
    |--------------------------------------------------------------------------
    | User must be logged in to access these routes
    |
    */
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    /*
    |--------------------------------------------------------------------------
    | Modified Orders Routes
    |--------------------------------------------------------------------------
    | User must be logged in to access these routes
    |
    */
    Route::get('/modified-orders', [ModifiedOrdersController::class, 'index'])->name('modified-orders.index');
    Route::get('/modified-orders/{id?}', [ModifiedOrdersController::class, 'show'])->name('modified-orders.show');


    /*
    |--------------------------------------------------------------------------
    | plans Routes
    |--------------------------------------------------------------------------
    | User must be logged in to access these routes
    |
    */


    Route::get('/upgrade-plan', function () {
        return view('seller.upgrade-plan');
    })->name('upgrade.plan');
});
