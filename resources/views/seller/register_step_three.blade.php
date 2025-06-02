@extends('seller.layouts.seller')

@section('content')
    <div class="w-full flex flex-col md:flex-row overflow-hidden">
        <!-- Left side with image and text -->
        <div class="md:w-1/2 relative flex flex-col justify-end p-10 bg-black">
            <img alt="Tools on wooden surface including screwdrivers, pliers, wrenches, and screws"
                class="absolute inset-0 w-full h-full object-cover brightness-75" height="900" loading="lazy"
                src="{{ asset('img/icons/01e45dc0c498ed7edb9fb296948de9aa731188b1.jpg') }}" width="600" />
            <div class="relative z-10 text-white max-w-md">
                <h2 class="text-2xl md:text-3xl font-semibold mb-2 leading-snug">
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
        <div class="md:w-1/2 bg-white rounded-r-3xl p-8 md:p-12 flex flex-col justify-between">
            <form method="POST" action="{{ route('seller.register.step3') }}" class="flex flex-col space-y-6" novalidate>
                @csrf

                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-base">
                        {{ __('Bank Details') }}
                    </h2>
                    <div class="flex items-center space-x-2 select-none">
                        <div class="w-4 h-4 rounded-sm bg-green-500"></div>
                        <div class="w-4 h-4 rounded-sm bg-green-500"></div>
                        <div class="w-4 h-4 rounded-sm bg-blue-600"></div>
                        <div class="w-4 h-4 rounded-sm bg-gray-300"></div>
                        <span class="text-xs text-gray-400 ml-3">
                            STEP
                            <span class="font-semibold">3</span>
                            OF 4
                        </span>
                    </div>
                </div>

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div>
                    <label for="bank_name" class="block text-sm font-normal text-black mb-1">
                        {{ __('Bank Name') }}<span class="text-red-600">*</span>
                    </label>
                    <input id="bank_name" name="bank_name" type="text" value="{{ old('bank_name') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7] @error('bank_name') border-red-500 @enderror" />
                    @error('bank_name')
                        <span class="text-red-500 text-xs mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="ifsc_code" class="block text-sm font-normal text-black mb-1">
                        {{ __('IFSC Code') }}<span class="text-red-600">*</span>
                    </label>
                    <input id="ifsc_code" name="ifsc_code" type="text" value="{{ old('ifsc_code') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7] @error('ifsc_code') border-red-500 @enderror" />
                    @error('ifsc_code')
                        <span class="text-red-500 text-xs mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="bank_account_number" class="block text-sm font-normal text-black mb-1">
                        {{ __('Bank Account Number') }}<span class="text-red-600">*</span>
                    </label>
                    <input id="bank_account_number" name="bank_account_number" type="text"
                        value="{{ old('bank_account_number') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7] @error('bank_account_number') border-red-500 @enderror" />
                    @error('bank_account_number')
                        <span class="text-red-500 text-xs mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="account_holder_name" class="block text-sm font-normal text-black mb-1">
                        {{ __('Account Holder Name') }} <span class="text-red-600">*</span>
                    </label>
                    <input id="account_holder_name" name="account_holder_name" type="text"
                        value="{{ old('account_holder_name') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7] @error('account_holder_name') border-red-500 @enderror" />
                    @error('account_holder_name')
                        <span class="text-red-500 text-xs mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="branch_location" class="block text-sm font-normal text-black mb-1">
                        {{ __('Branch Location') }} <span class="text-red-600">*</span>
                    </label>
                    <input id="branch_location" name="branch_location" type="text" value="{{ old('branch_location') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7] @error('branch_location') border-red-500 @enderror" />
                    @error('branch_location')
                        <span class="text-red-500 text-xs mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="text-xs text-gray-500">
                    {{ __('Your bank details are required for receiving payments.') }}
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mt-6">
                    <button type="submit" name="skip" value="1"
                        class="flex-1 bg-gray-200 text-gray-700 font-semibold text-base rounded-full py-3 hover:bg-gray-300 transition-colors">
                        {{ __('Skip for now') }}
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#fa6a5f] text-white font-semibold text-base rounded-full py-3 hover:bg-[#e55a4f] transition-colors">
                        {{ __('Complete Registration') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
