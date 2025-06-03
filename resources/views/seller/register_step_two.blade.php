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
                    {{ __('This data is needed so that we can easily provide you details about customers') }}
                </p>
            </div>
        </div>

        <!-- Right side form -->
        <div class="md:w-1/2 bg-white rounded-r-3xl p-8 md:p-12 flex flex-col justify-between">

            <!-- Error Messages -->
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('seller.register.step2') }}" class="flex flex-col space-y-6"
                novalidate="">
                @csrf

                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-base">
                        {{ __('Business Details') }}
                    </h2>
                    <div class="flex items-center space-x-2 select-none">
                        <div class="w-4 h-4 rounded-sm bg-green-500">
                        </div>
                        <div class="w-4 h-4 rounded-sm bg-blue-600">
                        </div>
                        <div class="w-4 h-4 rounded-sm bg-gray-300">
                        </div>
                        <div class="w-4 h-4 rounded-sm bg-gray-300">
                        </div>
                        <span class="text-xs text-gray-400 ml-3">
                            STEP
                            <span class="font-semibold">
                                2
                            </span>
                            OF 4
                        </span>
                    </div>
                </div>

                <!-- Trade License Number -->
                <div>
                    <label for="trade_license_number" class="block text-sm font-normal text-black mb-1">
                        {{ __('Trade License Number') }} <span class="text-red-600">*</span>
                    </label>
                    <input id="trade_license_number" name="trade_license_number" type="text"
                        value="{{ old('trade_license_number') }}"
                        class="w-full border {{ $errors->has('trade_license_number') ? 'border-red-500' : 'border-gray-300' }} rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7]" />
                    @error('trade_license_number')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- VAT -->
                <div>
                    <label for="vat" class="block text-sm font-normal text-black mb-1">
                        {{ __('VAT') }} <span class="text-red-600">*</span>
                    </label>
                    <input id="vat" name="vat" type="text" value="{{ old('vat') }}"
                        class="w-full border {{ $errors->has('vat') ? 'border-red-500' : 'border-gray-300' }} rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7]" />
                    @error('vat')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Product Category -->
                <div>
                    <label for="product_category" class="block text-sm font-normal text-black mb-1">
                        {{ __('Select product category/Name') }} <span class="text-red-600">*</span>
                    </label>
                    <select id="product_category" name="product_category"
                        class="w-full border {{ $errors->has('product_category') ? 'border-red-500' : 'border-gray-300' }} rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7]">
                        <option value="">{{ __('-- Select Category --') }}</option>
                        @if(isset($categories) && $categories->count() > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('product_category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        @else
                        @endif
                    </select>
                    @error('product_category')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-sm font-normal text-black mb-1">
                        {{ __('Contact Person Name') }} <span class="text-red-600">*</span>
                    </label>
                    <input id="contact_person" name="contact_person" type="text" value="{{ old('contact_person') }}"
                        class="w-full border {{ $errors->has('contact_person') ? 'border-red-500' : 'border-gray-300' }} rounded-md px-4 py-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-[#3b5de7]" />
                    @error('contact_person')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Office Address -->
                <div>
                    <label for="office_address" class="block text-sm font-normal text-black mb-1">
                        {{ __('Office Address') }} <span class="text-red-600">*</span>
                    </label>
                    <textarea id="office_address" name="office_address" rows="3"
                        class="w-full border {{ $errors->has('office_address') ? 'border-red-500' : 'border-gray-300' }} rounded-md px-4 py-2 text-sm text-black resize-none focus:outline-none focus:ring-1 focus:ring-[#3b5de7]">{{ old('office_address') }}</textarea>
                    @error('office_address')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Form Buttons -->
                <div class="flex flex-col space-y-3 mt-6">
                    <button type="submit"
                        class="w-full bg-[#fa6a5f] text-white font-semibold text-base rounded-full py-3 hover:bg-[#e55a4f] transition-colors">
                        {{ __('Continue') }}
                    </button>

                    <button type="submit" name="skip" value="1"
                        class="w-full border border-gray-300 text-gray-700 font-semibold text-base rounded-full py-3 hover:bg-gray-50 transition-colors">
                        {{ __('Skip for now') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
