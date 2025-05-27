@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Account') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <p>Step 2 of 3</p>
                            <div>
                                <span class="bg-success rounded-circle px-2 py-1 text-white">✓</span>
                                <span class="bg-primary rounded-circle px-2 py-1 text-white">2</span>
                                <span class="bg-secondary rounded-circle px-2 py-1 text-white">3</span>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <h5>Business Details</h5>

                        <form method="POST" action="{{ route('seller.register.step2') }}">
                            @csrf
                            <div id="business-fields">
                                <div class="mb-3">
                                    <label for="trade_license_number"
                                        class="form-label">{{ __('Trade License Number') }}<span
                                            class="text-danger-asterisk">*</span></label>
                                    <input id="trade_license_number" type="text"
                                        class="form-control @error('trade_license_number') is-invalid @enderror"
                                        name="trade_license_number" value="{{ old('trade_license_number') }}">
                                    @error('trade_license_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="vat" class="form-label">{{ __('VAT') }}<span
                                            class="text-danger-asterisk">*</span></label>
                                    <input id="vat" type="text"
                                        class="form-control @error('vat') is-invalid @enderror" name="vat"
                                        value="{{ old('vat') }}">
                                    @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="product_category"
                                        class="form-label">{{ __('Select product category/Name') }}<span
                                            class="text-danger-asterisk">*</span></label>
                                    <select id="product_category"
                                        class="form-select @error('product_category') is-invalid @enderror"
                                        name="product_category">
                                        <option value="">{{ __('-- Select Category --') }}</option>
                                        <option value="Cement & Materials"
                                            {{ old('product_category') == 'Cement & Materials' ? 'selected' : '' }}>Cement
                                            & Materials</option>
                                        <option value="Electronics"
                                            {{ old('product_category') == 'Electronics' ? 'selected' : '' }}>Electronics
                                        </option>
                                        <option value="Furniture"
                                            {{ old('product_category') == 'Furniture' ? 'selected' : '' }}>Furniture
                                        </option>
                                        <option value="Food & Beverage"
                                            {{ old('product_category') == 'Food & Beverage' ? 'selected' : '' }}>Food &
                                            Beverage</option>
                                    </select>
                                    @error('product_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_person" class="form-label">{{ __('Contact Person Name') }}<span
                                            class="text-danger-asterisk">*</span></label>
                                    <input id="contact_person" type="text"
                                        class="form-control @error('contact_person') is-invalid @enderror"
                                        name="contact_person" value="{{ old('contact_person') }}">
                                    @error('contact_person')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="office_address" class="form-label">{{ __('Office Address') }}<span
                                            class="text-danger-asterisk">*</span></label>
                                    <textarea id="office_address" class="form-control @error('office_address') is-invalid @enderror" name="office_address"
                                        rows="3">{{ old('office_address') }}</textarea>
                                    @error('office_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <p class="small text-muted">
                                    {{ __('This data is needed so that we can easily provide you details about customers.') }}
                                </p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" name="skip" value="1" class="btn btn-outline-secondary">
                                    {{ __('Skip for now') }}
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
