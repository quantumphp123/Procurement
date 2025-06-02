<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Customer\Customer;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.auth.signin-modal');
    }

    public function planSelection()
    {
        return view('customer.plan.plan_selection');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role_id != 2) {
                Auth::logout();
                return back()->with('error', 'Access denied. Only customers can login.');
            }
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return back()->with('error', 'Please verify your email before logging in.');
            }

            // Fetch customer record
            $customer = $user->customer;
            if ($customer) {
                $now = Carbon::now();
                // Check if trial is expired
                if ($customer->trial_ends_at && $now->gt(Carbon::parse($customer->trial_ends_at))) {
                    // Trial expired, check if paid plan is active
                    if (!$customer->plan_expires_at || $now->gt(Carbon::parse($customer->plan_expires_at))) {
                        Auth::logout();
                        return back()->with('error', 'Your free trial has expired. Please purchase a paid plan to continue.');
                    }
                }
            }

            // Authentication and checks passed...
            return redirect()->intended(route('website'));
        }
        return back()->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('website');
    }
}