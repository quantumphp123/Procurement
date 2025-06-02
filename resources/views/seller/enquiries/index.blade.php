@extends('seller.layouts.seller', ['pageTitle' => 'Enquiries'])

@section('title', 'Enquiries | Procurement Dashboard')

@section('content')
    <!-- Enquiries Table Section -->
    <div
        class="flex flex-wrap md:flex-nowrap items-center justify-between gap-4 px-4 pt-4 rounded-t-lg bg-white dark:bg-gray-800">
        <!-- Title -->
        <h2 class="flex-shrink-0 text-lg font-semibold text-gray-800 dark:text-white">
            Here's all the enquiries you got!
        </h2>
        <!-- Search Box -->
        <form method="GET" action="{{ route('seller.enquiries.index') }}" class="relative max-w-sm w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <img src="{{ asset('img/icons/search-icon.svg') }}" alt="search-icon" height="20" />
            </div>
            <input
                name="search"
                value="{{ request('search') }}"
                class="w-full max-w-xl pl-10 pr-4 py-2 text-sm text-gray-700 placeholder-gray-500 border-gray-300 rounded-lg dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 form-input"
                type="text" placeholder="Search enquiry number/customer name" aria-label="Search" />
        </form>
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
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Enquiry Number</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Customer Name</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Received On</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Action</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center text-sm text-black dark:text-gray-400">
                    @forelse($enquiries as $index => $enquiry)
                    <tr>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            {{ $enquiries->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            {{ $enquiry->enquiry_number }}
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            {{ $enquiry->user->name ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 border dark:border-gray-700">
                            {{ $enquiry->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 flex items-center justify-center dark:border-gray-700">
                            <button onclick="window.location.href='{{ route('seller.enquiries.show', $enquiry->id) }}'"
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
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                            No enquiries found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="grid px-0 bg-white rounded-b-lg sm:px-4 md:py-3 text-xs tracking-wide text-gray-500 border-t dark:border-gray-700 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800 gap-3">
            <span class="flex h-full items-center col-span-1 md:col-span-3 lg:col-span-3 mt-2 sm:mt-auto sm:justify-start">
                {{ $enquiries->appends(request()->query())->links('pagination::bootstrap-4') }}
            </span>
            <span class="col-span-1 md:col-span-2 lg:col-span-2"></span>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end col-span-12 md:col-span-12 lg:col-span-4 gap-2 sm:gap-4">
                <span class="font-semibold">
                    Showing {{ $enquiries->firstItem() }} to {{ $enquiries->lastItem() }} of {{ $enquiries->total() }} entries
                </span>
                <div class="relative hidden md:flex" x-data="{
                    dropdownOpen: false,
                    dropdownOption: 'Show {{ $enquiries->perPage() }}',
                    options: ['Show 2', 'Show 10', 'Show 12', 'Show 20', 'Show 25'],
                    openUpward: false,
                    toggleDropdown(el) {
                        this.dropdownOpen = !this.dropdownOpen;

                        if (this.dropdownOpen) {
                            const rect = el.getBoundingClientRect();
                            const spaceBelow = window.innerHeight - rect.bottom;
                            const spaceAbove = rect.top;

                            this.openUpward = spaceBelow < 150 && spaceAbove > 150;
                        }
                    }
                }" x-init="$watch('dropdownOpen', val => { if (!val) openUpward = false })">
                    <button @click="toggleDropdown($el)"
                        class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-700 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-between min-w-[110px]">
                        <span x-text="dropdownOption"></span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                        </svg>
                    </button>
                    <ul x-show="dropdownOpen" @click.outside="dropdownOpen = false"
                        x-bind:class="{ 'bottom-full mb-2': openUpward, 'mt-2': !openUpward }"
                        class="absolute z-10 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg transition-all duration-150 ease-out">
                        <template x-for="option in options" :key="option">
                            <li @click="dropdownOption = option; dropdownOpen = false" x-text="option"
                                class="px-4 py-2 text-sm cursor-pointer"
                                :class="{
                                    'bg-gray-200 dark:bg-gray-700 font-semibold text-gray-900 dark:text-white': dropdownOption === option,
                                    'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700': dropdownOption !== option
                                }">
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
