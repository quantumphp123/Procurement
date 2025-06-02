<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CustomerRegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Customer\VatDocument;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }



    public function create()
    {
        return view('customer.auth.signup');
    }

    public function store(CustomerRegisterRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Create user first
            $userData = [
                'name' => 'Customer',
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'role_id' => 2, // Hardcoded role_id for Customer
            ];

            $user = User::create($userData);

            // Set trial period dates
            $trialStartsAt = now();
            $trialEndsAt = now()->addDays(30);

            // Prepare customer data without plan
            $customerData = [
                'company_name' => $request->company_name,
                'license_number' => $request->license_number,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_designation' => $request->contact_person_designation,
                'user_id' => $user->id,
                'trial_starts_at' => $trialStartsAt,
                'trial_ends_at' => $trialEndsAt,
                'is_trial_active' => true,
                'plans' => null,
                'plan_expires_at' => null
            ];

            // Create customer with all dates
            $customer = Customer::create($customerData);

            // Handle VAT document upload if present
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $filePath = $file->store('vat_documents', 'public');

                // Create VAT document record
                VatDocument::create([
                    'customer_id' => $customer->id,
                    'vat_number' => $request->vat_number,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath
                ]);
            }

            // Log the dates for debugging
            Log::info('Customer created with dates:', [
                'customer_id' => $customer->id,
                'trial_starts_at' => $customer->trial_starts_at,
                'trial_ends_at' => $customer->trial_ends_at,
                'is_trial_active' => $customer->is_trial_active,
                'plans' => $customer->plans,
                'plan_expires_at' => $customer->plan_expires_at
            ]);

            // Send verification email
            event(new Registered($user));

            DB::commit();

            return redirect()->back()
                ->with('show_verification', true)
                ->with('email', $user->email)
                ->with('message', 'Registration successful! Please verify your email address to select your plan.')
                ->with('alert-type', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);

            return redirect()->back()
                ->withInput()
                ->with('message', 'Registration failed: ' . $e->getMessage())
                ->with('alert-type', 'error');
        }
    }

    public function verify($id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('customer.register')
                ->with('message', 'Invalid verification link.')
                ->with('alert-type', 'error');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('customer.plan.selection')
                ->with('message', 'Email already verified. Please select a plan.')
                ->with('alert-type', 'info');
        }

        $user->markEmailAsVerified();

        // Log the user in after verification
        auth()->login($user);

        // Redirect to plan selection with trial period info
        return redirect()->route('customer.plan.selection')
            ->with('message', 'Email verified successfully! Please select your plan to start your 30-day trial.')
            ->with('alert-type', 'success')
            ->with('trial_starts_at', now())
            ->with('trial_ends_at', now()->addDays(30));
    }

    public function updatePlan(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $customer = $user->customer;
            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer profile not found'
                ], 404);
            }

            // If no plan is specified, return error
            if (!$request->has('plan')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select a plan'
                ], 400);
            }

            $plan = $request->plan;
            $validPlans = ['free', 'basic', 'premium'];
            if (!in_array($plan, $validPlans)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid plan selected'
                ], 400);
            }

            // Set plan expiration based on the selected plan
            $planExpiresAt = null;
            if ($plan === 'free') {
                // Free plan expires after 30 days from selection
                $planExpiresAt = now()->addDays(30);
            } elseif ($plan === 'basic' || $plan === 'premium') {
                // Paid plans expire after 30 days from selection
                $planExpiresAt = now()->addDays(30);
            }

            // Update the plan and expiration
            $customer->update([
                'plans' => $plan,
                'plan_expires_at' => $planExpiresAt,
                'is_trial_active' => false, // End trial when plan is selected
                'trial_ends_at' => now() // Set trial end to now when plan is selected
            ]);

            // Log the plan update for debugging
            Log::info('Plan updated:', [
                'customer_id' => $customer->id,
                'plan' => $plan,
                'plan_expires_at' => $planExpiresAt,
                'is_trial_active' => false,
                'trial_ends_at' => now()
            ]);

            $message = $plan === 'free'
                ? 'Free plan selected. Your plan will expire in 30 days.'
                : 'Plan selected successfully. Your subscription is active for 30 days.';

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('website')
            ]);
        } catch (\Exception $e) {
            Log::error('Plan update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update plan. Please try again.'
            ], 500);
        }
    }

    // Add a method to check plan status
    public function checkPlanStatus(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $customer = $user->customer;
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $now = now();
        $planExpired = $customer->plan_expires_at && $customer->plan_expires_at->lt($now);
        $trialExpired = $customer->is_trial_active && $customer->trial_ends_at->lt($now);

        $status = 'active';
        if ($planExpired) {
            $status = 'expired';
        } elseif ($customer->is_trial_active) {
            $status = 'trial';
        }

        return response()->json([
            'current_plan' => $customer->plans,
            'plan_expires_at' => $customer->plan_expires_at,
            'is_trial_active' => $customer->is_trial_active,
            'trial_ends_at' => $customer->trial_ends_at,
            'plan_expired' => $planExpired,
            'trial_expired' => $trialExpired,
            'status' => $status
        ]);
    }
}