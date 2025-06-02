@extends('seller.layouts.seller')
@section('title', 'Sign In')
@section('content')
    <div class="w-full flex flex-col md:flex-row overflow-hidden">
        <!-- Left side with image and text -->
        <div class="w-full md:w-1/2 relative flex flex-col justify-end p-6 md:p-10 bg-black h-[30vh] md:h-[100vh]">
            <img alt="Tools on wooden surface including screwdrivers, pliers, wrenches, and screws"
                class="absolute inset-0 w-full h-full object-cover brightness-75" style="height: 100%; width: 100%;"
                loading="lazy" src="{{ asset('img/icons/01e45dc0c498ed7edb9fb296948de9aa731188b1.jpg') }}" />
            <div class="relative z-10 text-white max-w-md">
                <h2 class="text-xl md:text-3xl font-semibold mb-2 leading-snug">
                    We need some of your
                    <span class="inline-block">
                        Information
                    </span>
                </h2>
                <p class="text-xs md:text-sm max-w-xs">
                    This data is needed so that we can easily provide you details about customers
                </p>
            </div>
        </div>

        <!-- Right side form -->
        <div class="md:w-1/2 bg-white rounded-r-3xl p-8 md:p-12 flex flex-col justify-center items-center">
            <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg relative" id="signin-modal">

                <!-- Header -->
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Sign In</h2>
                <p class="text-sm text-gray-600 mb-6">
                    Don't have an account?
                    <a href="{{ route('seller.register') }}"
                        class="text-orange-500 font-medium underline hover:text-orange-600">Sign Up</a>
                </p>

                <!-- Sign In Form -->
                <form method="POST" action="{{ route('seller.login') }}">
                    @csrf

                    <!-- Email Input -->
                    <label for="signin-email" class="block text-sm font-medium mb-1 text-gray-800">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative mb-4">
                        <input id="signin-email" type="email" name="email"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('email') border-red-500 @enderror"
                            placeholder="you@example.com" value="{{ old('email') }}" autocomplete="email" autofocus />

                        {{-- Only show green checkmark if email passes validation AND no session error --}}
                        @if (!$errors->has('email') && old('email') && !session('error'))
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute right-3 top-3.5 w-5 h-5 text-green-500 pointer-events-none" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @endif

                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <label for="signin-password" class="block text-sm font-medium mb-1 text-gray-800">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative mb-1">
                        <input id="signin-password" type="password" name="password"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('password') border-red-500 @enderror"
                            placeholder="Enter your password" autocomplete="current-password" />
                        <button type="button" tabindex="-1"
                            class="absolute right-3 top-3.5 w-5 h-5 text-gray-500 hover:text-gray-700 focus:outline-none"
                            onclick="const p=document.getElementById('signin-password');p.type=p.type==='password'?'text':'password';this.querySelector('svg').classList.toggle('hidden');this.querySelectorAll('svg')[1].classList.toggle('hidden');">
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

                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-right text-sm mb-6">
                        <a href="{{ route('password.request') }}" class="text-orange-500 hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input mr-2"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="text-sm text-gray-600" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit"
                        class="w-full bg-[#FF6B5F] hover:bg-orange-600 text-white font-semibold py-3 rounded-full text-lg mb-4 transition">
                        Sign In
                    </button>
                </form>

                <!-- reCAPTCHA Notice -->
                <p class="text-[11px] text-center text-gray-500">
                    Protected by reCAPTCHA and subject to the
                    <a href="#" class="text-orange-500 underline hover:text-orange-600">ProTrade's Privacy
                        Policy</a> and
                    <a href="#" class="text-orange-500 underline hover:text-orange-600">Terms of Service</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
