@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Dashboard') }}</span>
                        <span class="badge bg-success">Seller Account</span>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h5 class="mb-4">Welcome, {{ Auth::user()->name }}!</h5> <!-- Seller Dashboard Content -->
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        Profile Completion Status
                                    </div>
                                    <div class="card-body">
                                        <div class="progress mb-3">
                                            @php
                                                $completionSteps = 1; // Basic info is completed
                                                if (Auth::user()->hasCompletedBusinessInfo()) {
                                                    $completionSteps++;
                                                }
                                                if (Auth::user()->hasCompletedBankInfo()) {
                                                    $completionSteps++;
                                                }
                                                $completionPercentage = ($completionSteps / 3) * 100;
                                            @endphp
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $completionPercentage }}%"
                                                aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ round($completionPercentage) }}%
                                            </div>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Basic Information
                                                <span class="badge bg-success rounded-pill">✓</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Business Details
                                                @if (Auth::user()->hasCompletedBusinessInfo())
                                                    <span class="badge bg-success rounded-pill">✓</span>
                                                @else
                                                    <a href="{{ route('register.step2.form') }}"
                                                        class="btn btn-sm btn-primary">Complete</a>
                                                @endif
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Bank Details
                                                @if (Auth::user()->hasCompletedBankInfo())
                                                    <span class="badge bg-success rounded-pill">✓</span>
                                                @else
                                                    <a href="{{ route('register.step3.form') }}"
                                                        class="btn btn-sm btn-primary">Complete</a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Analytics -->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card bg-primary text-white">
                                            <div class="card-body">
                                                <h5 class="card-title">Products</h5>
                                                <h2 class="mb-0">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card bg-success text-white">
                                            <div class="card-body">
                                                <h5 class="card-title">Orders</h5>
                                                <h2 class="mb-0">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card bg-info text-white">
                                            <div class="card-body">
                                                <h5 class="card-title">Revenue</h5>
                                                <h2 class="mb-0">$0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
