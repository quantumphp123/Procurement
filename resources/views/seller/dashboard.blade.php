@extends('layouts.seller')

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

        <div class="flex flex-wrap gap-6">
            <!-- Buttons -->
            <div x-data="{ isOpenMySubscription: false, tab: 'plan' }" class="relative">
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

                <!-- Modal Backdrop -->
                <div x-show="isOpenMySubscription" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" x-cloak
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
                    @keydown.escape.window="isOpenMySubscription = false">

                    <!-- Modal -->
                    <div x-show="isOpenMySubscription" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-6"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-6" x-cloak @click.away="isOpenMySubscription = false"
                        class="bg-white rounded-lg shadow-lg w-full max-w-md md:max-w-2xl" role="dialog" aria-modal="true"
                        aria-labelledby="modal-title">

                        <!-- Header -->
                        <div class="flex justify-between items-center px-6 py-4 border-b">
                            <h2 id="modal-title" class="text-lg font-semibold">My Subscription</h2>
                            <div class="flex items-center">
                                <button
                                    class="bg-orange-400 hover:bg-orange-500 text-white text-sm px-4 py-2 rounded-full mr-4">
                                    Upgrade Plan
                                </button>
                                <button @click="isOpenMySubscription = false" aria-label="Close modal"
                                    class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Tabs -->
                        <div class="flex px-6 border-b text-sm font-medium space-x-6 mt-2">
                            <button
                                :class="tab === 'plan' ? 'text-blue-600 border-b-2 border-blue-600' :
                                    'text-gray-500'"
                                class="pb-2" @click="tab = 'plan'" type="button">
                                Plan
                            </button>
                            <button
                                :class="tab === 'history' ? 'text-blue-600 border-b-2 border-blue-600' :
                                    'text-gray-500'"
                                class="pb-2" @click="tab = 'history'" type="button">
                                History
                            </button>
                        </div>

                        <!-- Tab Panels -->
                        <div class="p-6 text-sm">
                            <!-- Plan Tab -->
                            <div x-show="tab === 'plan'" x-transition>
                                <div class="border rounded-lg p-4 space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold text-lg">Basic Plan</span>
                                        <span class="text-xs bg-green-500 text-white px-2 py-1 rounded-full">ACTIVE</span>
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
                                <p class="text-gray-500 italic">No history found.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
        </div>
    </div>

    <!-- Stats Cards -->
    @include('seller.partials.stats-cards')

    <!-- Enquiries Table -->
    @include('seller.partials.enquiries-table')
@endsection

@push('modals')
    <!-- Add any additional modals here -->
@endpush
