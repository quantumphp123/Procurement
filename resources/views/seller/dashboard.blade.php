@extends('seller.layouts.seller')
@section('title', 'Procurement Dashboard')
@section('content')
    <!-- Welcome Section -->

    <div class="my-4 flex flex-wrap gap-2 justify-between items-center">
        <div class="px-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-200 mb-2">
                Hi, {{ Auth::user()->name ?? 'Jane' }}
            </h2>
            <p class="text-gray-600 mb-2 font-medium">This is your product report so far</p>
        </div>

        <div class="flex flex-wrap gap-6" x-data="{ isModalOpen: false, isOpenMySubscription: false, tab: 'plan' }">
            <div class="relative">
                <!-- Trigger Button -->
                <button @click="isOpenMySubscription = true"
                    class="flex items-center justify-between px-6 py-3 text-base font-semibold text-orange-600 border-2 border-orange-600 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105">
                    <span>My Subscription</span>
                    <div class="p-1 ml-3 rounded-full text-white bg-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 20L20 4M20 4H10M20 4V14" />
                        </svg>
                    </div>
                </button>

                <!-- Modal Wrapper -->
                <template x-if="isOpenMySubscription">
                    <div x-cloak class="fixed inset-0 flex items-center justify-center z-50">

                        <!-- Backdrop -->
                        <div @click="isOpenMySubscription = false"
                            x-transition:enter="transition-opacity ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="absolute inset-0 bg-black bg-opacity-50">
                        </div>

                        <!--Subscription Modal -->
                        <div x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 translate-y-6"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-6" @click.away="isOpenMySubscription = false"
                            class="relative z-10 bg-white rounded-lg shadow-lg w-full max-w-md md:max-w-2xl" role="dialog"
                            aria-modal="true" aria-labelledby="modal-title">
                            <div class="flex justify-end items-center px-6 py-4">
                                <button @click="isOpenMySubscription = false" aria-label="Close modal"
                                    class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Header -->
                            <div class="flex justify-between items-center px-6 py-4">
                                <h2 id="modal-title" class="text-lg font-semibold">My Subscription</h2>
                                <div class="flex items-center justify-end">
                                    <button onclick="window.location.href='/seller/upgrade-plan'"
                                        class="bg-orange-400 hover:bg-orange-500 text-white text-sm px-6 font-medium py-3 rounded-full">
                                        Upgrade Plan
                                    </button>
                                </div>
                            </div>

                            <!-- Tabs -->
                            <div class="flex px-6 border-b text-sm font-medium space-x-6">
                                <button
                                    :class="tab === 'plan' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500'"
                                    class="pb-2" @click="tab = 'plan'" type="button">Plan</button>
                                <button
                                    :class="tab === 'history' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500'"
                                    class="pb-2" @click="tab = 'history'" type="button">History</button>
                            </div>

                            <!-- Tab Panels -->
                            <div class="p-6 text-sm">
                                <!-- Plan Tab -->
                                <div x-show="tab === 'plan'" x-transition>
                                    <div class="border rounded-lg p-4 space-y-4">
                                        <div class="flex gap-3 items-center pb-3 border-b border-gray-200">
                                            <span class="font-semibold text-lg">Basic Plan</span>
                                            <span
                                                class="text-xs bg-green-600 text-white px-3 py-1 rounded-[5px]">ACTIVE</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-y-2 text-gray-600">
                                            <span>Plan Valid Till</span>
                                            <span class="text-black font-medium">23 Jan 2026</span>

                                            <span>Price</span>
                                            <span class="text-black font-medium">$499.90</span>

                                            <span>Plan Validity</span>
                                            <span class="text-black font-medium">364 Days</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- History Tab -->
                                <div x-show="tab === 'history'" x-transition>
                                    <div class="w-full overflow-hidden bg-white py-3 dark:bg-gray-900">
                                        <div class="w-full overflow-x-auto">
                                            <table class="w-full border">
                                                <!-- Table Head -->
                                                <thead>
                                                    <tr
                                                        class="text-sm font-semibold border tracking-wide text-black-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">
                                                            Plan</th>
                                                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">
                                                            Status</th>
                                                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">
                                                            Created Date</th>
                                                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">
                                                            End Date</th>
                                                    </tr>
                                                </thead>
                                                <!-- Table Body -->
                                                <tbody
                                                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center text-sm text-black dark:text-gray-400">
                                                    <tr>
                                                        <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                                            01
                                                        </td>
                                                        <td class="px-4 py-3 flex justify-center dark:border-gray-700">
                                                            <span
                                                                class="px-2 py-1 font-semibold leading-tight uppercase min-w-[100px] text-green-500 bg-green-100 rounded-[6px] dark:bg-green-700 dark:text-green-100">
                                                                Active
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm  border dark:border-gray-700">
                                                            23/04/2024
                                                        </td>
                                                        <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                                            22/04/2025
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                                            02
                                                        </td>
                                                        <td class="px-4 py-3 flex justify-center dark:border-gray-700">
                                                            <span
                                                                class="px-2 py-1 font-semibold min-w-[100px] leading-tight uppercase text-gray-500 bg-gray-100 rounded-[6px] dark:bg-green-700 dark:text-green-100">
                                                                Not Active
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm  border dark:border-gray-700">
                                                            12/03/2022
                                                        </td>
                                                        <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                                            08/03/2023
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                                            03
                                                        </td>
                                                        <td class="px-4 py-3 flex justify-center dark:border-gray-700">
                                                            <span
                                                                class="px-2 py-1 min-w-[100px] font-semibold leading-tight uppercase text-gray-500 bg-gray-100 rounded-[6px] dark:bg-green-700 dark:text-green-100">
                                                                Not Active
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm  border dark:border-gray-700">
                                                            15/01/2021
                                                        </td>
                                                        <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                                            12/01/2022
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <button @click="isModalOpen = true"
                class="flex items-center justify-between px-6 py-3 text-base font-semibold text-orange-600 border-2 border-orange-600 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105">
                <span>Add Product</span>
                <div class="p-1 ml-3 rounded-full text-white bg-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
            </button>

            <!-- Add Product Modal -->
            <template x-if="isModalOpen">
                <div x-cloak
                    class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
                    x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <!-- Modal -->
                    <div x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 transform translate-y-1/2"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="isModalOpen = false"
                        @keydown.escape="isModalOpen = false"
                        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                        role="dialog">
                        <header class="flex justify-end">
                            <button
                                class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                                aria-label="close" @click="isModalOpen = false">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                                    aria-hidden="true">
                                    <path
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </header>

                        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <!-- Title -->
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Add Product</h2>

                                <!-- Display Validation Errors -->
                                @if ($errors->any())
                                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800">Please fix the following
                                                    errors:</h3>
                                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Product Category -->
                                <div class="mb-4">
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Product Category <span class="text-red-500">*</span>
                                    </label>
                                    <select name="category_id" id="category_id"
                                        class="w-full border text-sm @error('category_id') border-red-500 @else border-gray-300 @enderror rounded-md px-4 py-2 focus:border-0 focus:outline-none focus:ring-2 @error('category_id') focus:ring-red-500 @else focus:ring-orange-500 @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Product Name -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Product Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" placeholder="Enter Product Name"
                                        value="{{ old('name') }}"
                                        class="w-full border text-sm @error('name') border-red-500 @else border-gray-300 @enderror rounded-md px-4 py-2 focus:border-0 focus:outline-none focus:ring-2 @error('name') focus:ring-red-500 @else focus:ring-orange-500 @enderror">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Upload Image -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Upload Image
                                    </label>

                                    <div class="border-2 border-dashed @error('image') border-red-300 @else border-gray-300 @enderror rounded-md p-6 text-center cursor-pointer hover:border-orange-400"
                                        onclick="document.getElementById('image').click()">
                                        <input type="file" id="image" name="image" class="hidden"
                                            accept="image/*" />
                                        <label for="image" class="block text-sm text-gray-500 cursor-pointer">
                                            <span class="text-orange-600 font-medium">Click to upload</span> or drag and
                                            drop<br />
                                            <span class="text-xs text-gray-400">Images only (max 20 MB)</span>
                                        </label>
                                    </div>
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-between items-center">
                                    <button type="button" @click="isModalOpen = false"
                                        class="w-1/2 mr-2 bg-gray-100 text-gray-500 border-2 border-gray-200 font-medium py-2 rounded-full hover:bg-gray-200 transition duration-200 ease-in-out">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="w-1/2 ml-2 bg-orange-500 text-white font-semibold py-2 rounded-full hover:bg-orange-600 transition duration-200 ease-in-out">
                                        Add Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <!-- Stats Cards -->
    @include('seller.partials.stats-cards', [$totalEnquiries])

    <!-- Enquiries Table -->
    @include('seller.partials.enquiries-table')
    <!-- Success Toast -->

    {{-- Include Success Modal Component --}}
    @include('seller.success-modal', [
        'title' => 'Welcome to ProTrade!',
        'message' => 'Your seller account is now active. Start adding your products!',
        'buttonText' => 'Start Selling',
        'onClickAction' => 'startSelling()',
    ])
@endsection
@push('script')
    <script>
        function startSelling() {
            closeModal();
            window.location.href = '{{ route('seller.dashboard') }}';
        }

        // Show different success messages based on session
        @if (session('registration_success'))
            // Registration success - show welcome message
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessModal();
            });
        @endif
    </script>
@endpush
