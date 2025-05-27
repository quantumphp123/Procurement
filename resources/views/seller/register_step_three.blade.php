@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Complete Your Account') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <p>Step 3 of 3</p>
                            <div>
                                <span class="bg-success rounded-circle px-2 py-1 text-white">✓</span>
                                <span class="bg-success rounded-circle px-2 py-1 text-white">✓</span>
                                <span class="bg-primary rounded-circle px-2 py-1 text-white">3</span>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <h5>Bank Details</h5>

                        <form method="POST" action="{{ route('seller.register.step3') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="bank_name" class="form-label">{{ __('Bank Name') }}<span
                                        class="text-danger-asterisk">*</span></label>
                                <input id="bank_name" type="text"
                                    class="form-control @error('bank_name') is-invalid @enderror" name="bank_name"
                                    value="{{ old('bank_name') }}">
                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ifsc_code" class="form-label">{{ __('IFSC Code') }}<span
                                        class="text-danger-asterisk">*</span></label>
                                <input id="ifsc_code" type="text"
                                    class="form-control @error('ifsc_code') is-invalid @enderror" name="ifsc_code"
                                    value="{{ old('ifsc_code') }}">
                                @error('ifsc_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bank_account_number" class="form-label">{{ __('Bank Account Number') }}<span
                                        class="text-danger-asterisk">*</span></label>
                                <input id="bank_account_number" type="text"
                                    class="form-control @error('bank_account_number') is-invalid @enderror"
                                    name="bank_account_number" value="{{ old('bank_account_number') }}">
                                @error('bank_account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="account_holder_name" class="form-label">{{ __('Account Holder Name') }}<span
                                        class="text-danger-asterisk">*</span></label>
                                <input id="account_holder_name" type="text"
                                    class="form-control @error('account_holder_name') is-invalid @enderror"
                                    name="account_holder_name" value="{{ old('account_holder_name') }}">
                                @error('account_holder_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="branch_location" class="form-label">{{ __('Branch Location') }}<span
                                        class="text-danger-asterisk">*</span></label>
                                <input id="branch_location" type="text"
                                    class="form-control @error('branch_location') is-invalid @enderror"
                                    name="branch_location" value="{{ old('branch_location') }}">
                                @error('branch_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <p class="small text-muted">
                                    {{ __('Your bank details are required for receiving payments.') }}
                                </p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" name="skip" value="1" class="btn btn-outline-secondary">
                                    {{ __('Skip for now') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Complete Registration') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
