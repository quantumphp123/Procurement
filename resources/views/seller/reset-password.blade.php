@extends('layouts.app')

@section('content')
    <div class="max-w-md w-full bg-white rounded-2xl p-8 shadow-md relative" id="reset-password-modal">
        <!-- Branding -->
        <div class="flex justify-center mb-8">
            <button class="bg-[#071829] rounded-full px-8 py-3 flex items-center space-x-1" aria-label="ProTrade logo">
                <span class="text-[#2B6CF6] font-semibold text-lg">Pro</span>
                <span class="text-white font-semibold text-lg">Trade</span>
                <span class="w-2 h-2 rounded-full bg-[#2B6CF6] inline-block"></span>
            </button>
        </div>

        <!-- Content -->
        <h1 class="text-2xl font-semibold text-[#1E1E1E] mb-2">{{ __('Reset Password') }}</h1>
        <p class="text-[#4B4B4B] text-base mb-8">
            Ensure your account is using a long, random password to stay secure.
        </p>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6" novalidate>
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#1E1E1E] mb-1">
                    {{ __('Email Address') }} <span class="text-[#E03E4E]">*</span>
                </label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                    placeholder="Enter your email address"
                    class="w-full rounded-md border border-[#E5E7EB] px-4 py-3 text-[#6B7280] text-base placeholder:text-[#6B7280] focus:outline-none focus:ring-2 focus:ring-[#2B6CF6] @error('email') border-[#E03E4E] focus:ring-[#E03E4E] @enderror"
                    required autocomplete="email" autofocus />

                @error('email')
                    <span class="text-[#E03E4E] text-sm mt-1 block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- New Password Field -->
            <div>
                <label for="password" class="block text-sm font-semibold text-[#1E1E1E] mb-1">
                    {{ __('New Password') }} <span class="text-[#E03E4E]">*</span>
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Enter new password"
                        class="w-full rounded-md border border-[#E5E7EB] px-4 py-3 pr-12 text-[#6B7280] text-base placeholder:text-[#6B7280] focus:outline-none focus:ring-2 focus:ring-[#2B6CF6] @error('password') border-[#E03E4E] focus:ring-[#E03E4E] @enderror"
                        autocomplete="new-password" />
                    <button type="button"
                        class="absolute inset-y-0 right-3 flex items-center text-[#6B7280] text-lg password-toggle"
                        tabindex="-1" data-target="password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                @error('password')
                    <span class="text-[#E03E4E] text-sm mt-1 block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#1E1E1E] mb-1">
                    {{ __('Confirm New Password') }} <span class="text-[#E03E4E]">*</span>
                </label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Confirm new password"
                        class="w-full rounded-md border border-[#E5E7EB] px-4 py-3 pr-12 text-[#6B7280] text-base placeholder:text-[#6B7280] focus:outline-none focus:ring-2 focus:ring-[#2B6CF6] @error('password_confirmation') border-[#E03E4E] focus:ring-[#E03E4E] @enderror"
                        required autocomplete="new-password" />
                    <button type="button"
                        class="absolute inset-y-0 right-3 flex items-center text-[#6B7280] text-lg password-toggle"
                        tabindex="-1" data-target="password_confirmation">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                @error('password_confirmation')
                    <span class="text-[#E03E4E] text-sm mt-1 block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-[#FA6B5F] text-white font-semibold text-base rounded-full py-3 mt-1 hover:bg-[#f85a4f] transition-colors">
                {{ __('Reset Password') }}
            </button>

            <!-- Cancel Button -->
            <a href="{{ route('login') }}"
                class="w-full border border-[#6B7280] text-[#6B7280] font-semibold text-base rounded-full py-3 mt-1 hover:bg-[#F3F4F6] transition-colors block text-center">
                {{ __('Cancel') }}
            </a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const toggleButtons = document.querySelectorAll('.password-toggle');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (targetInput.type === 'password') {
                        targetInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        targetInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
@endsection
