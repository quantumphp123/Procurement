@extends('seller.layouts.seller', ['pageTitle' => 'Customers', 'breadcrumbTitle' => 'Check out the list of all the customers who have signed up on this platform!', 'breadcrumbRoute' => 'seller.customers.index'])
@section('title', 'Customers | Procurement Dashboard')

@section('content')
    <div
        class="flex flex-wrap md:flex-nowrap items-center justify-between gap-4 px-4 pt-4 rounded-t-lg bg-white dark:bg-gray-800">
        <!-- Title -->
        <h2 class="lg:w-1/3 text-lg font-semibold text-gray-800 dark:text-white">
            Check out the list of all the customers who've signed up on this platform!
        </h2>

        <!-- Search Box -->
        <div class="relative max-w-sm w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <img src="{{ asset('img/icons/search-icon.svg') }}" alt="search-icon" height="20" />
            </div>
            <input
                class="w-full max-w-xl pl-10 pr-4 py-2 text-sm text-gray-700 placeholder-gray-500 border-gray-300 rounded-lg dark:placeholder-gray-400 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 form-input"
                type="text" placeholder="Search enquiry number/customer name" aria-label="Search" />
        </div>
    </div>
    <div class="w-full overflow-hidden bg-white px-4 mb-5 py-5 rounded-b-lg dark:bg-gray-800">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-s font-semibold border tracking-wide text-black-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 border-r dark:border-gray-700">SL No.</th>
                        <th class="px-4 py-3 border-r dark:border-gray-700">Company Name</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                    @forelse($customers as $customer)
                        <tr class="text-black-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm border-l border-r dark:border-gray-700">
                                {{ $customer['sl_no'] }}
                            </td>
                            <td class="px-4 py-3 text-sm border-r dark:border-gray-700">
                                {{ $customer['company_name'] }}
                            </td>
                            <td class="px-4 py-3 border-r flex justify-center dark:border-gray-700">
                                <button onclick="window.location.href='{{ route('seller.customers.show', $customer['id']) }}'"
                                    class="group flex items-center justify-center px-2 py-2 text-sm font-medium leading-5 text-white transition-all duration-200 bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 hover:shadow-lg focus:outline-none focus:shadow-outline-orange"
                                    aria-label="View">
                                    <svg class="w-5 h-5 transition-transform duration-200 transform group-hover:scale-110 group-hover:stroke-white"
                                        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-black-700 dark:text-gray-400">
                            <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                                No customers found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div
            class="grid px-0 bg-white rounded-b-lg sm:px-4 md:py-3 text-xs tracking-wide text-gray-500 border-t dark:border-gray-700 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800 gap-3">
            <span class="flex h-full items-center col-span-1 md:col-span-3 lg:col-span-3 mt-2 sm:mt-auto sm:justify-start">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center font-semibold">
                        <li>
                            <button
                                class="px-0 sm:px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-orange"
                                aria-label="Previous">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button
                                class="px-3 py-1 text-white transition-colors duration-150 bg-orange-500 border border-orange-500 rounded-md focus:outline-none focus:shadow-outline-orange">
                                1
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-orange">
                                2
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-orange">
                                3
                            </button>
                        </li>
                        <li>
                            <span class="px-3 py-1">...</span>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-orange">
                                9
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-orange">
                                10
                            </button>
                        </li>
                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-orange"
                                aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
            <span class="col-span-1 md:col-span-2 lg:col-span-2"></span>
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-end col-span-12 md:col-span-12 lg:col-span-4 gap-2 sm:gap-4">
                <span class="font-semibold">Showing {{ $pagination['from'] }} to {{ $pagination['to'] }} of {{ $pagination['total'] }} entries</span>
                <div class="relative hidden md:flex" x-data="{
                    dropdownOpen: false,
                    dropdownOption: 'Show {{ $pagination['per_page'] }}',
                    options: ['Show 8', 'Show 10', 'Show 12', 'Show 20', 'Show 25'],
                    openUpward: false,
                    toggleDropdown(el) {
                        this.dropdownOpen = !this.dropdownOpen;

                        if (this.dropdownOpen) {
                            const rect = el.getBoundingClientRect();
                            const spaceBelow = window.innerHeight - rect.bottom;
                            const spaceAbove = rect.top;

                            // if space below is less than 150px and above has more, open upward
                            this.openUpward = spaceBelow < 150 && spaceAbove > 150;
                        }
                    }
                }" x-init="$watch('dropdownOpen', val => { if (!val) openUpward = false })">
                    <button @click="toggleDropdown($el)"
                        class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-700 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-between min-w-[110px]">
                        <span x-text="dropdownOption"></span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                        </svg>
                    </button>

                    <!-- Dropdown Options -->
                    <ul x-show="dropdownOpen" @click.outside="dropdownOpen = false"
                        x-bind:class="{ 'bottom-full mb-2': openUpward, 'mt-2': !openUpward }"
                        class="absolute z-10 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg transition-all duration-150 ease-out">
                        <template x-for="option in options" :key="option">
                            <li @click="dropdownOption = option; dropdownOpen = false" x-text="option"
                                class="px-4 py-2 text-sm cursor-pointer"
                                :class="{
                                    'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white': dropdownOption ===
                                        option,
                                    'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700': dropdownOption !==
                                        option
                                }">
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
