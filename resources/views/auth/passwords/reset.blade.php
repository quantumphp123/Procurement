@extends('seller.layouts.seller')

@section('content')
    <!-- Reset Password Page -->
    <div class="min-h-screen flex bg-gray-50">
        <!-- Left side with image and text -->
        <div class="w-1/2 relative flex flex-col justify-end p-6 md:p-10 bg-black">
            <img alt="Tools on wooden surface including screwdrivers, pliers, wrenches, and screws"
                class="absolute inset-0 w-full h-full object-cover brightness-75" loading="lazy"
                src="{{ asset('img/icons/01e45dc0c498ed7edb9fb296948de9aa731188b1.jpg') }}" />
            <div class="relative z-10 text-white max-w-md">
                <h2 class="text-2xl md:text-4xl font-semibold mb-4 leading-tight">
                    We need some of your Information
                </h2>
                <p class="text-[#4B4B4B] text-base mb-8">
                    This data is needed so that we can easily provide you details about customers
                </p>
            </div>
        </div>

        <!-- Right side with form -->
        <div class="w-1/2 flex items-center justify-center p-8">
            <div class="bg-white rounded-3xl max-w-md w-full p-8 shadow-xl">
                <!-- Logo -->
                <button aria-label="ProTrade logo"
                    class="bg-[#071B2F] rounded-full px-8 py-3 flex items-center justify-center mx-auto mb-8"
                    style="min-width: 160px;">
                    <span class="text-[#2B6BFF] font-semibold text-lg leading-none">Pro</span>
                    <span class="text-white font-semibold text-lg leading-none">Trade</span>
                    <span class="text-[#2B6BFF] text-lg leading-none ml-1">•</span>
                </button>

                <!-- Title -->
                <h1 class="text-2xl font-semibold text-[#1E1E1E] mb-2">Reset Password</h1>
                <p class="text-[#4B4B4B] text-base mb-8">
                    Ensure your account is using a long, random password to stay secure.
                </p>

                <!-- Success Message -->
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-[#3C3C3C] mb-2">
                            New Password <span class="text-red-600">*</span>
                        </label>
                        <div class="relative">
                            <input id="password" name="password" type="password" placeholder="Enter New password"
                                class="w-full rounded-md border border-[#E5E7EB] px-4 py-3 pr-12 text-[#6B7280] text-base placeholder:text-[#6B7280] focus:outline-none focus:ring-2 focus:ring-[#2B6CF6]"
                                autocomplete="new-password" />
                            <button type="button" onclick="togglePassword('password')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6B7280] text-lg hover:text-[#2B6BFF]"
                                tabindex="-1">
                                <i id="password-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-[#3C3C3C] mb-2">
                            Confirm New Password <span class="text-red-600">*</span>
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="Confirm New Password"
                                class="w-full rounded-md border border-[#E5E7EB] px-4 py-3 pr-12 text-[#6B7280] text-base placeholder:text-[#6B7280] focus:outline-none focus:ring-2 focus:ring-[#2B6CF6]"
                                autocomplete="new-password" />
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6B7280] text-lg hover:text-[#2B6BFF]"
                                tabindex="-1">
                                <i id="password_confirmation-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#FF6B5F] text-white text-base font-medium rounded-full py-4 hover:bg-[#ff5a4d] transition-colors mb-4">
                        Reset Password
                    </button>

                    <button type="button"
                        class="w-full border border-gray-300 text-gray-600 text-base font-medium rounded-full py-4 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
