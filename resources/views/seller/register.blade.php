@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Account') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <p>Step 1 of 3</p>
                        <div>
                            <span class="bg-primary rounded-circle px-2 py-1 text-white">1</span>
                            <span class="bg-secondary rounded-circle px-2 py-1 text-white">2</span>
                            <span class="bg-secondary rounded-circle px-2 py-1 text-white">3</span>

                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p>Already Have an Account? <a href="{{ route('seller.login') }}">Sign In</a></p>

                    <h5>Personal Details</h5>

                    <form method="POST" action="{{ route('seller.register.store') }}">
                        @csrf
                        <input id="role_id" type="hidden" value="3" name="role_id">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">{{ __('Your Full Name') }}<span
                                    class="text-danger-asterisk">*</span></label>
                            <input id="full_name" type="text"
                                class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                value="{{ old('full_name') }}">
                            @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Enter Email ID') }}<span
                                    class="text-danger-asterisk">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">{{ __('Enter Mobile Number') }}<span
                                    class="text-danger-asterisk">*</span></label>
                            <input id="phone_number" type="text"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ old('phone_number') }}" autocomplete="tel">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}<span
                                    class="text-danger-asterisk">*</span></label>
                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                            </div>
                            @error('password')
                                <span class="error-msg text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Re-Enter Password') }}<span
                                    class="text-danger-asterisk">*</span></label>
                            <div class="input-group">
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <span class="error-msg text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <p class="small text-muted">
                                {{ __('This data is needed so that we can easily provide you details about customers.') }}
                            </p>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Continue') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
