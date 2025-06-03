@extends('seller.layouts.seller', ['pageTitle' => 'Modified Orders', 'breadcrumbTitle' => 'Modified Orders', 'breadcrumbRoute' => 'seller.modified-orders.index', 'breadcrumbCurrent' => 'view'])

@section('title', 'View Modified Order | Procurement Dashboard')

@section('content')

    <div class="bg-white pt-4 px-4 rounded-t-lg dark:bg-gray-900">
        <!-- Customer Info -->
        <div
            class="bg-gray-100 border border-gray-300 p-4 rounded-lg w-full mx-auto text-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-wrap gap-4 lg:justify-between text-black dark:text-gray-300">
                <!-- Customer Name -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-900 whitespace-nowrap dark:text-gray-400">Customer
                        Name:</span>
                    <span class="bg-gray-300 px-4 py-2 rounded-md font-semibold dark:bg-gray-600">Ajinkya
                        Patil</span>
                </div>
                <!-- Contact -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-900 whitespace-nowrap dark:text-gray-400">Contact:</span>
                    <span class="bg-gray-300 px-4 py-2 rounded-md font-semibold dark:bg-gray-600">+91
                        7832773822</span>
                </div>
                <!-- Enquiry Number -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-900 whitespace-nowrap dark:text-gray-400">Enquiry
                        Number:</span>
                    <span class="bg-gray-300 px-4 py-2 rounded-md font-semibold dark:bg-gray-600">423</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Table -->
    <div class="w-full overflow-hidden bg-white px-4 py-5 dark:bg-gray-900">
        <div class="w-full overflow-x-auto">
            <table class="w-full border">
                <!-- Table Head -->
                <thead>
                    <tr
                        class="text-sm font-semibold border tracking-wide text-black-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">SL No.</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Item's Name</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Qty</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700 max-w-xs">Reseason
                            for
                            Modification
                        </th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Manufacturer</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Price</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Unit Price</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center text-sm text-black dark:text-gray-400">
                    <tr>
                        <td class="px-4 py-3 border dark:border-gray-700">01</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">Steel Beams</td>
                        <td class="px-4 py-3 border dark:border-gray-700">10 Units</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                            <div class="truncate-text">
                                Need price Negotiation & Review it
                            </div>
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">JSM Steels</td>
                        <td class="px-4 py-3 border dark:border-gray-700">$423.78</td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            $12.78
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border dark:border-gray-700">02</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">Steel Beams</td>
                        <td class="px-4 py-3 border dark:border-gray-700">10 Units</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                            <div class="truncate-text">
                                Need price Negotiation & Review it
                            </div>
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">JSM Steels</td>
                        <td class="px-4 py-3 border dark:border-gray-700">$423.78</td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            $12.78
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border dark:border-gray-700">03</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">Steel Beams</td>
                        <td class="px-4 py-3 border dark:border-gray-700">10 Units</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                            <div class="truncate-text">
                                Need price Negotiation & Review it
                            </div>
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">JSM Steels</td>
                        <td class="px-4 py-3 border dark:border-gray-700">$423.78</td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            $12.78
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border dark:border-gray-700">04</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">Steel Beams</td>
                        <td class="px-4 py-3 border dark:border-gray-700">10 Units</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                            <div class="truncate-text">
                                Need price Negotiation & Review it
                            </div>
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">JSM Steels</td>
                        <td class="px-4 py-3 border dark:border-gray-700">$423.78</td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            $12.78
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 border dark:border-gray-700">05</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">Steel Beams</td>
                        <td class="px-4 py-3 border dark:border-gray-700">10 Units</td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                            <div class="truncate-text">
                                Need price Negotiation & Review it
                            </div>
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">JSM Steels</td>
                        <td class="px-4 py-3 border dark:border-gray-700">$423.78</td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            $12.78
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Billing Section -->
    <div class="bg-white rounded-b-lg pb-5 mb-4 dark:bg-gray-900">
        <div
            class="flex flex-col mx-4 md:flex-row justify-between gap-6 p-6 bg-gray-100 rounded-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-600">
            <!-- Left Column -->
            <div class="mb-3 md:mb-0 text-md">
                <p class="text-gray-800 dark:text-gray-400">
                    <span class="font-medium">Delivery date:</span>
                    <span class="font-semibold">12/02/2025</span>
                </p>
            </div>
            <!-- Right Section: col2 + col3 -->
            <div class="flex flex-col lg:flex-row gap- md:gap-12 text-gray-700 w-full">
                <!-- Column 2 -->
                <div class="flex-1 space-y-4">
                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">Total Price:</span>
                        <span class="text-lg font-semibold text-black dark:text-gray-300">$2390.23</span>
                    </div>
                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">Discount:</span>
                        <!-- <input type="text" value="8%" class="w-20 text-right px-3 py-1 border border-gray-300 rounded-md font-semibold
         focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800
         dark:bg-gray-800 dark:text-white dark:border-gray-600
         dark:focus:ring-blue-500 dark:focus:border-blue-500" /> -->
                        <span class="text-lg font-semibold text-black dark:text-gray-300">10 %</span>
                    </div>
                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">Discounted Price:</span>
                        <span class="text-lg font-semibold text-black dark:text-gray-300">$2350.00</span>
                    </div>
                </div>
                <!-- Column 3 -->
                <div class="flex-1 space-y-4">
                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">VAT:</span>
                        <!-- <input type="text" value="8%" class="w-20 text-right px-3 py-1 border border-gray-300 rounded-md font-semibold
         focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800
         dark:bg-gray-800 dark:text-white dark:border-gray-600
         dark:focus:ring-blue-500 dark:focus:border-blue-500" /> -->
                        <span class="text-lg font-semibold text-black dark:text-gray-300">123</span>
                    </div>
                    <!-- <div class="flex justify-between items-center h-10">
                                                <span class="font-medium">Delivery Charge:</span>
                                                <input type="text" value="$12.2" class="w-20 text-right px-3 py-1 border border-gray-300 rounded-md font-semibold
         focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800
         dark:bg-gray-800 dark:text-white dark:border-gray-600
         dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                            </div> -->
                    <div class="flex items-center h-10">
                        <div class="w-full border-b border-gray-300 dark:border-gray-600"></div>
                    </div>

                    <div class="flex justify-between items-center h-10">
                        <span class="text-lg font-semibold text-black dark:text-white">Final
                            Price:</span>
                        <span class="text-lg font-bold text-orange-800 dark:text-gray-100">$2358.23</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Buttons -->
        <div class="flex border-t border-gray-300 mt-4 mx-4 pt-4 flex-wrap justify-center gap-6 dark:border-gray-700">
            <button
                class="flex w-48 items-center justify-center px-6 py-2 bg-red-100 text-base font-semibold text-red-600 border-2 border-red-600 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105">

                <div class="p-1 mr-1 rounded-full text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 hover:text-red-600 cursor-pointer"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
                <span>Decline</span>
            </button>
            <button onclick="window.location.href='edit-modified-order.html'"
                class="px-6 py-2 w-48 bg-orange-600 text-base font-semibold text-white border-2 border-orange-600 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105">
                Modify
            </button>
        </div>
    </div>

@endsection
