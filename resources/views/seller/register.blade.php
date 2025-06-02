@extends('seller.layouts.seller')
@section('content')
    <div class="w-full flex flex-col md:flex-row overflow-hidden min-h-screen">
        <!-- Left side with image and text -->
        <div class="md:w-1/2 relative flex flex-col justify-end p-10 bg-black">
            <img alt="Tools on wooden surface including screwdrivers, pliers, wrenches, and screws"
                class="absolute inset-0 w-full h-full object-cover brightness-75" height="900" loading="lazy"
                src="{{ asset('img/icons/01e45dc0c498ed7edb9fb296948de9aa731188b1.jpg') }}" width="600" />

            <div class="relative z-10 text-white max-w-md">
                <h2 class="text-2xl md:text-3xl font-semibold mb-2 leading-snug">
                    We need some of your
                    <span class="inline-block">Information</span>
                </h2>
                <p class="text-xs md:text-sm max-w-xs">
                    This data is needed so that we can easily provide you details about customers
                </p>
            </div>
        </div>

        <!-- Right side form -->
        <div class="md:w-1/2 bg-white rounded-r-3xl p-8 md:p-12 flex flex-col justify-between">
            <form class="flex flex-col space-y-6" method="POST" action="{{ route('seller.register.store') }}"
                id="registrationForm">
                @csrf
                <div>
                    <h1 class="text-xl font-semibold mb-2">{{ __('Create New Account') }}</h1>
                    <p class="text-xs mb-6">
                        Already Have an Account?
                        <a class="text-red-500 hover:underline" href="{{ route('seller.login') }}">Sign In</a>
                    </p>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-base">Personal Details</h2>
                    <div class="flex items-center space-x-2 select-none">
                        <div class="w-4 h-4 rounded-sm bg-blue-600"></div>
                        <div class="w-4 h-4 rounded-sm bg-gray-300"></div>
                        <div class="w-4 h-4 rounded-sm bg-gray-300"></div>
                        <div class="w-4 h-4 rounded-sm bg-gray-300"></div>
                        <span class="text-xs text-gray-400 ml-3">
                            STEP <span class="font-semibold">1</span> OF 4
                        </span>
                    </div>
                </div>

                <!-- Hidden role_id field -->
                <input type="hidden" id="role_id" name="role_id" value="3">

                <!-- Full Name Field -->
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-medium" for="fullname">
                        {{ __('Your Full Name') }} <span class="text-red-600">*</span>
                    </label>
                    <input
                        class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('full_name') border-red-500 @enderror"
                        id="fullname" name="full_name" type="text" value="{{ old('full_name') }}" autocomplete="name" />
                    @error('full_name')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror

                </div>

                <!-- Email Field -->
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-medium" for="email">
                        {{ __('Enter Email ID') }} <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <input
                            class="border border-gray-300 rounded-md px-3 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full @error('email') border-red-500 @enderror"
                            id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" />
                        <i aria-hidden="true"
                            class="fas fa-check text-green-500 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none hidden"
                            id="email-check"></i>
                    </div>
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mobile Number Field -->
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-medium" for="mobile">
                        {{ __('Enter Mobile Number') }} <span class="text-red-600">*</span>
                    </label>
                    <input
                        class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone_number') border-red-500 @enderror"
                        id="mobile" name="phone_number" type="text" value="{{ old('phone_number') }}"
                        autocomplete="tel" />
                    @error('phone_number')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="flex flex-col space-y-2 relative">
                    <label class="text-xs font-medium" for="password">
                        {{ __('Password') }} <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <input
                            class="border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full @error('password') border-red-500 @enderror"
                            id="password" name="password" placeholder="Enter your password" type="password"
                            autocomplete="new-password" />
                        <button type="button" tabindex="-1"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 hover:text-gray-600 focus:outline-none"
                            onclick="const p=document.getElementById('password');p.type=p.type==='password'?'text':'password';this.querySelector('svg').classList.toggle('hidden');this.querySelectorAll('svg')[1].classList.toggle('hidden');">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.873 6.876A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.03M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path d="M3 3l18 18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="flex flex-col space-y-2 relative">
                    <label class="text-xs font-medium" for="repassword">
                        {{ __('Re-Enter Password') }} <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <input
                            class="border border-gray-300 rounded-md px-3 py-2 pr-10 text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full @error('password_confirmation') border-red-500 @enderror"
                            id="repassword" name="password_confirmation" placeholder="Re-Enter your password"
                            type="password" />
                        <button type="button" tabindex="-1"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 hover:text-gray-600 focus:outline-none"
                            onclick="const p=document.getElementById('repassword');p.type=p.type==='password'?'text':'password';this.querySelector('svg').classList.toggle('hidden');this.querySelectorAll('svg')[1].classList.toggle('hidden');">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.873 6.876A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.03M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path d="M3 3l18 18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button
                    class="bg-red-500 hover:bg-red-400 text-white font-semibold rounded-full py-3 mt-4 transition-colors"
                    type="submit" id="submitBtn">
                    {{ __('Continue') }}
                </button>
            </form>
        </div>
    </div>
    @push('script')
        <script>
            // Real-time email validation with check mark
            document.addEventListener('DOMContentLoaded', function() {
                const emailField = document.getElementById('email');
                const checkIcon = document.getElementById('email-check');

                if (emailField && checkIcon) {
                    emailField.addEventListener('blur', function() {
                        const email = this.value.trim();

                        if (email && isValidEmail(email)) {
                            checkIcon.classList.remove('hidden');
                        } else {
                            checkIcon.classList.add('hidden');
                        }
                    });
                }

                // Form submission with loading state
                const form = document.getElementById('registrationForm');
                const submitBtn = document.getElementById('submitBtn');

                if (form && submitBtn) {
                    form.addEventListener('submit', function(e) {
                        submitBtn.disabled = true;
                        submitBtn.textContent = 'Processing...';
                        submitBtn.classList.add('opacity-50');
                    });
                }

                // Clear validation errors on input
                const fields = ['fullname', 'email', 'mobile', 'password', 'repassword'];

                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.addEventListener('input', function() {
                            this.classList.remove('border-red-500');
                            // Hide any adjacent error messages
                            const errorDiv = this.closest('.flex').querySelector('.text-red-500');
                            if (errorDiv) {
                                errorDiv.style.display = 'none';
                            }
                        });
                    }
                });
            });

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        </script>
    @endpush
@endsection
