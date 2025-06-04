@extends('seller.layouts.seller')
@extends('seller.layouts.seller', ['pageTitle' => 'My Subscription', 'breadcrumbTitle' => 'Dashboard', 'breadcrumbRoute' => 'seller.dashboard', 'breadcrumbCurrent' => 'Upgrade
                                Plan'])

@section('title', 'Upgrade Plan | Procurement Dashboard')

@section('content')
    <div class="container-fluid px-6 mx-auto grid">
        <section class="bg-white dark:bg-gray-900">
            <div class="container px-6 py-6 mx-auto">
                <div>
                    <h2 class="text-2xl text-center font-semibold text-gray-600 lg:text-3xl dark:text-gray-100">
                        Select
                        your perfect plan to upgrade</h2>
                    <p class="mt-4 text-gray-500 dark:text-gray-300 text-center">All plans auto-renew
                        monthly. You can upgrade, or cancel anytime it from visiting here</p>
                </div>

                <div class="grid px-2 gap-6 mt-10 -mx-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div
                        class="px-6 py-4 transition-colors duration-300 transform rounded-2xl hover:text-gray-300 hover:bg-gray-800 0 border dark:hover:bg-gray-800">
                        <p class="text-lg font-medium dark:text-gray-100">Free</p>

                        <small class="mt-4 dark:text-gray-300">Free plan for 7 days
                            trial.</small>
                        <h4 class="mt-2 text-center text-3xl font-semibold dark:text-gray-100">
                            $0.00 <span class="text-base font-normal text-gray-400 dark:text-gray-400">/
                                7 Days</span></h4>

                        <div class="mt-8 space-y-8">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 dark:text-gray-300">
                                    Receive limited
                                    enquiries (up to 20/month)
                                </span>

                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4 dark:text-gray-300">
                                    View enquiries from selected product categories
                                </span>

                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4 dark:text-gray-300">
                                    Access to standard
                                    dashboard and order tracking
                                </span>
                            </div>
                        </div>

                        <button
                            class="mt-6 w-full text-orange-500 border-2 border-orange-400 hover:text-white transition ease-in-out duration-200 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                            Save & Continue
                        </button>
                    </div>

                    <div
                        class="px-6 py-4 transition-colors duration-300 transform border rounded-2xl hover:text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-800">
                        <p class="text-lg font-medium dark:text-gray-100">Basic
                        </p>
                        <small class="mt-4 dark:text-gray-300">Perfect for beginners</small>
                        <h4 class="mt-2 text-3xl text-center font-semibold dark:text-gray-100">
                            $7.99 <span class="text-base font-normal text-gray-400 dark:text-gray-400">/
                                1 Month</span>
                        </h4>

                        <div class="mt-8 space-y-8">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 dark:text-gray-300">
                                    Receive limited
                                    enquiries (up to 20/month)
                                </span>

                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4 dark:text-gray-300">
                                    View enquiries from selected product categories
                                </span>

                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4 dark:text-gray-300">
                                    Access to standard
                                    dashboard and order tracking
                                </span>
                            </div>
                        </div>

                        <button
                            class="mt-6 w-full text-orange-500 border-2 border-orange-400 hover:text-white transition ease-in-out duration-200 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                            Save & Continue
                        </button>
                    </div>
                    <div
                        class="px-6 py-4 transition-colors duration-300 transform border rounded-2xl hover:text-gray-300 hover:bg-gray-800 dark:hover:bg-gray-800">
                        <div class="flex flex-wrap justify-between items-center">
                            <span class="text-lg font-medium dark:text-gray-100">Standard
                            </span>
                            <span class="text-xs bg-green-600 text-white px-3 py-1 rounded-[5px]">ACTIVE</span>

                        </div>
                        <small class="mt-4 dark:text-gray-300">Save upto <b>$20.99</b>
                            Monthly</small>
                        <h4 class="mt-2 text-3xl text-center font-semibold dark:text-gray-100">
                            $10.99 <span class="text-base font-normal text-gray-400 dark:text-gray-400">/
                                2 Months</span>
                        </h4>

                        <div class="mt-8 space-y-8">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 dark:text-gray-300">
                                    Receive limited
                                    enquiries (up to 20/month)
                                </span>

                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4 dark:text-gray-300">
                                    View enquiries from selected product categories
                                </span>

                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4 dark:text-gray-300">
                                    Access to standard
                                    dashboard and order tracking
                                </span>
                            </div>
                        </div>

                        <button
                            class="mt-6 w-full text-orange-500 border-2 border-orange-400 hover:text-white transition ease-in-out duration-200 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                            Save & Continue
                        </button>
                    </div>
                    <div
                        class="px-6 py-4 transition-colors duration-300 transform border rounded-2xl hover:text-gray-300 hover:bg-gray-800 dark:bg-gray-800">
                        <p class="text-lg font-medium">Premium</p>
                        <small class="mt-4">Save upto <b>$100</b> Yearly</small>
                        <h4 class="mt-2 text-3xl font-semibold">$99.99 <span class="text-base font-normal text-gray-400">/
                                Year</span></h4>

                        <div class="mt-8 space-y-8">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4">Receive limited enquiries (up to
                                    20/month)</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4">View enquiries from selected product
                                    categories</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>

                                <span class="ml-4">Access to standard dashboard and order
                                    tracking</span>
                            </div>
                        </div>

                        <button
                            class="mt-6 w-full text-orange-500 border-2 border-orange-400 hover:text-white transition ease-in-out duration-200 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                            Save & Continue
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
