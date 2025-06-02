@extends('seller.layouts.seller')

@section('content')
    <!-- Forgot Password Modal -->
    <div class="min-h-screen flex bg-gray-50">
        <!-- Left side with image and text -->
        <div class="w-1/2 relative flex flex-col justify-end p-6 md:p-10 bg-black">
            <img alt="Tools on wooden surface including screwdrivers, pliers, wrenches, and screws"
                class="absolute inset-0 w-full h-full object-cover brightness-75"
                loading="lazy" src="{{asset('img/icons/01e45dc0c498ed7edb9fb296948de9aa731188b1.jpg')}}" />
            <div class="relative z-10 text-white max-w-md">
                <h2 class="text-2xl md:text-4xl font-semibold mb-4 leading-tight">
                    We need some of your
                    <br>
                    <span class="block">
                        Information
                    </span>
                </h2>
                <p class="text-sm md:text-base max-w-sm opacity-90">
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
                <h1 class="text-2xl font-semibold text-[#1E1E1E] mb-4 text-center">Forgot Password</h1>
                <p class="text-[#666666] text-sm mb-6 leading-relaxed text-center">
                    Enter Email ID that you have registered with us <br />
                    starts with <strong>john************@example.com</strong>
                </p>

                <!-- Success Message -->
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="email" class="block text-sm font-medium text-[#3C3C3C] mb-2">Email <span
                            class="text-red-600">*</span></label>
                    <div class="relative mb-4">
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="pristia@gmail.com"
                            class="w-full rounded-xl border border-gray-300 px-4 py-4 pr-12 text-[#1E1E1E] text-sm focus:outline-none focus:ring-2 focus:ring-[#2B6BFF] focus:border-transparent @error('email') border-red-500 @enderror"
                             />
                        @if (!$errors->has('email') && old('email'))
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#2B6BFF] text-lg" aria-hidden="true">
                                ✓
                            </span>
                        @endif
                        @error('email')
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-red-500 text-lg" aria-hidden="true">
                                ⚠
                            </span>
                        @enderror
                    </div>

                    @error('email')
                        <span class="text-red-500 text-sm mb-4 block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit"
                        class="w-full bg-[#FF6B5F] text-white text-base font-medium rounded-full py-4 hover:bg-[#ff5a4d] transition-colors mb-4">
                        Reset Password
                    </button>

                    <a href="{{ route('seller.login') }}"
                        class="w-full border border-gray-300 text-gray-600 text-base font-medium rounded-full py-4 hover:bg-gray-50 transition-colors block text-center">
                        Back to Login
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
