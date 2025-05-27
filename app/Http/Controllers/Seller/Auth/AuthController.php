<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Models\User;
use App\Models\BankDetail;
use App\Models\SellerProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Seller\RegisterStepOneRequest;
use App\Http\Requests\Seller\RegisterStepTwoRequest;
use App\Http\Requests\Seller\RegisterStepThreeRequest;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only apply guest middleware to step 1 registration routes
        $this->middleware('guest')->only(['showRegistrationForm', 'register']);
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('seller.register');
    }

    /**
     * Process step one of registration.
     *
     * @param RegisterStepOneRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterStepOneRequest $request)
    {
        try {
            // Create the user
            $seller = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => preg_replace('/\D/', '', $request->phone_number),
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id ?? 3,
            ]);

            // Send email verification notification
            $seller->sendEmailVerificationNotification();

            // Log the user in automatically after registration
            Auth::login($seller);

            // Redirect to step two with success message
            return redirect()->route('seller.register.step2.form')
                ->with('success', 'Personal details saved successfully! Please complete the next step.');
        } catch (\Exception $e) {
             Log::error('Registration failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    /**
     * Show step two registration form.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showStepTwoForm()
    {
        $user = Auth::user();

        // Check if user is authenticated and is a seller
        if (!Auth::check() || !$user->isSeller()) {
            return redirect()->route('register')
                ->with('error', 'Please complete the first step of registration.');
        }

        return view('seller.register_step_two');
    }

    /**
     * Process the step two registration form.
     * @param RegisterStepTwoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processStepTwo(RegisterStepTwoRequest $request)
    {
        try {
            // Get authenticated user
            $user = Auth::user();

            if (!$user || !$user->isSeller()) {
                return redirect()->route('register')
                    ->with('error', 'Please complete the first step of registration.');
            }

            // If skip button is clicked, redirect to dashboard
            if ($request->has('skip')) {
                return redirect()->route('seller.dashboard')
                    ->with('info', 'Welcome! You can complete your business profile anytime from settings.');
            }

            // Update or create seller profile
            SellerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'trade_license_number' => $request->trade_license_number,
                    'vat' => $request->vat,
                    'product_category' => $request->product_category,
                    'contact_person' => $request->contact_person,
                    'office_address' => $request->office_address,
                    'business_info_completed' => true
                ]
            );

            // Redirect to next step
            return redirect()->route('seller.register.step3.form')
                ->with('success', 'Business details saved successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'There was a problem saving your business details. Please try again.');
        }
    }

    /**
     * Show the step three registration form (Bank Details).
     */
    public function showStepThreeForm()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('register')
                ->with('error', 'Please login to continue the registration process.');
        }

        $user = Auth::user();

        // Check if user is a seller
        if (!$user->isSeller()) {
            return redirect()->route('seller.register.step1.form')
                ->with('error', 'Please register as a seller first.');
        }

        // Check if user has completed step two
        if (!$user->hasCompletedBusinessInfo()) {
            return redirect()->route('seller.register.step2.form')
                ->with('error', 'Please complete your business details before proceeding.');
        }

        // Check if bank details already exist
        $existingBankDetails = BankDetail::where('user_id', $user->id)->first();
        if ($existingBankDetails) {
            return redirect()->route('seller.dashboard')
                ->with('info', 'Bank details already provided. You can update them from your settings.');
        }

        return view('seller.register_step_three');
    }

    /**
     * Process the step three registration form.
     */
    public function processStepThree(RegisterStepThreeRequest $request)
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return redirect()->route('login')
                    ->with('error', 'Your session has expired. Please login to continue.');
            }

            $user = Auth::user();

            // Check if business details are completed
            if (!$user->hasCompletedBusinessInfo()) {
                return redirect()->route('seller.register.step2.form')
                    ->with('error', 'Please complete your business details first.');
            }

            // If skip button is clicked, mark registration as complete but set bank_info_completed to false
            if ($request->has('skip')) {
                return redirect()->route('seller.dashboard')
                    ->with('success', 'Welcome to your dashboard! You can complete your bank details anytime from settings.');
            }

            // First check if bank details already exist
            $existingBankDetails = BankDetail::where('user_id', $user->id)->first();

            if ($existingBankDetails) {
                return redirect()->route('seller.dashboard')
                    ->with('info', 'Bank details already exist. You cannot modify them at this stage.');
            }

            // Create new bank details
            BankDetail::create([
                'user_id' => $user->id,
                'bank_name' => $request->bank_name,
                'ifsc_code' => strtoupper($request->ifsc_code),
                'bank_account_number' => $request->bank_account_number,
                'account_holder_name' => $request->account_holder_name,
                'branch_location' => $request->branch_location,
                'bank_info_completed' => true
            ]);

            return redirect()->route('seller.dashboard')
                ->with('success', 'Registration completed successfully! Welcome to your dashboard.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'We encountered an issue processing your request. Please try again.')
                ->withInput();
        }
    }
}
