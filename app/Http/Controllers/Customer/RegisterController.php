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
use App\Http\Requests\Customer\UpdateCustomerDetailsRequest;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{




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
            return redirect()->route('customer.login')
                ->with('message', 'Email already verified. Please login to continue.')
                ->with('alert-type', 'info');
        }

        $user->markEmailAsVerified();

        // Don't log the user in automatically after verification
        // Instead, redirect to login with success message
        return redirect()->route('customer.login')
            ->with('message', 'Email verified successfully! Please login to continue.')
            ->with('alert-type', 'success');
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

    public function customerDetails()
    {
        $user = auth()->user();
        $customer = $user->customer;

        return view('customer.account.customer_detail', [
            'user' => $user,
            'customer' => $customer
        ]);
    }

    public function updateCustomerDetails(UpdateCustomerDetailsRequest $request)
    {
        try {
            $user = auth()->user();
            $customer = $user->customer;

            // Debug information
            Log::info('Update Customer Details Request:', [
                'has_file' => $request->hasFile('profile_pic'),
                'file_info' => $request->file('profile_pic') ? [
                    'original_name' => $request->file('profile_pic')->getClientOriginalName(),
                    'mime_type' => $request->file('profile_pic')->getMimeType(),
                    'size' => $request->file('profile_pic')->getSize(),
                ] : null,
                'all_data' => $request->except(['profile_pic'])
            ]);

            DB::beginTransaction();

            // Handle profile picture upload
            if ($request->hasFile('profile_pic')) {
                Log::info('Processing profile picture upload');

                // Delete old profile picture if exists
                if ($user->profile_pic) {
                    Log::info('Deleting old profile picture', ['path' => $user->profile_pic]);
                    Storage::disk('public')->delete($user->profile_pic);
                }

                $file = $request->file('profile_pic');
                Log::info('Storing new profile picture', [
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);

                // Ensure the directory exists
                $directory = 'profile';
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                $path = $file->store($directory, 'public');
                Log::info('File stored at path', ['path' => $path]);

                if (!$path) {
                    throw new \Exception('Failed to store the file');
                }

                // Update user with new profile picture
                $user->update([
                    'profile_pic' => $path,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
                Log::info('User updated with new profile picture', ['path' => $path]);
            } else {
                Log::info('No profile picture uploaded, updating user data only');
                // Update user data without profile picture
                $user->update([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
            }

            // Update customer data
            $customer->update([
                'company_name' => $request->company_name,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_designation' => $request->contact_person_designation,
            ]);

            DB::commit();
            Log::info('Company details updated successfully');

            return redirect()->route('customer.company.details')->with([
                'message' => 'Company details updated successfully.',
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update company details: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'customer_id' => $customer->id,
                'request_data' => $request->except(['profile_pic']),
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to update company details: ' . $e->getMessage())
                ->withInput();
        }
    }

    // public function updateProfileImage(Request $request)
    // {
    //     try {
    //         Log::info('Profile image upload started', [
    //             'user_id' => auth()->id(),
    //             'has_file' => $request->hasFile('profile_pic'),
    //             'file_info' => $request->file('profile_pic') ? [
    //                 'original_name' => $request->file('profile_pic')->getClientOriginalName(),
    //                 'mime_type' => $request->file('profile_pic')->getMimeType(),
    //                 'size' => $request->file('profile_pic')->getSize(),
    //             ] : null
    //         ]);

    //         if (!$request->hasFile('profile_pic')) {
    //             throw new \Exception('No file uploaded');
    //         }

    //         $request->validate([
    //             'profile_pic' => 'required|file|mimes:jpg,jpeg,png|max:2048'
    //         ]);

    //         $user = auth()->user();

    //         // Delete old profile picture if exists
    //         if ($user->profile_pic) {
    //             $oldPath = $user->profile_pic;
    //             Log::info('Deleting old profile picture', ['path' => $oldPath]);
    //             Storage::disk('public')->delete($oldPath);
    //         }

    //         $file = $request->file('profile_pic');
    //         $fileName = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

    //         Log::info('Attempting to store file', [
    //             'file_name' => $fileName,
    //             'original_name' => $file->getClientOriginalName(),
    //             'mime_type' => $file->getMimeType(),
    //             'size' => $file->getSize()
    //         ]);

    //         // Ensure the directory exists
    //         $directory = 'profile';
    //         if (!Storage::disk('public')->exists($directory)) {
    //             Storage::disk('public')->makeDirectory($directory);
    //         }

    //         $path = $file->storeAs($directory, $fileName, 'public');

    //         if (!$path) {
    //             throw new \Exception('Failed to store the file');
    //         }

    //         Log::info('File stored successfully', ['path' => $path]);

    //         // Update user with new profile picture
    //         $user->profile_pic = $path;
    //         $saved = $user->save();

    //         if (!$saved) {
    //             throw new \Exception('Failed to update user profile');
    //         }

    //         Log::info('Profile picture updated successfully', [
    //             'user_id' => $user->id,
    //             'file_path' => $path,
    //             'full_url' => asset('storage/' . $path)
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Profile picture updated successfully',
    //             'image_url' => asset('storage/' . $path)
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to update profile picture: ' . $e->getMessage(), [
    //             'user_id' => auth()->id(),
    //             'exception' => $e,
    //             'request_data' => $request->except(['profile_pic']),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update profile picture: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
}