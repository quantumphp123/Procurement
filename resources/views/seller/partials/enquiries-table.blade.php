<!-- Recent Enquiries Section -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <!-- Header with Search and Filter -->
    <div class="flex flex-wrap md:flex-nowrap items-center justify-between gap-4 px-4 pt-4 rounded-t-lg bg-white dark:bg-gray-800">
        <!-- Title -->
        <h2 class="flex-shrink-0 text-lg font-semibold text-gray-800 dark:text-white">
            Recent Enquiries
        </h2>

        <!-- Search + Filter Form -->
        <form method="GET" action="{{ route('seller.dashboard') }}" class="flex flex-wrap md:flex-nowrap items-center gap-4 ml-auto min-w-0 w-full md:w-auto">
            <!-- Search Box -->
            <div class="relative max-w-xs w-full min-w-0">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input
                    name="search"
                    value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2 text-sm text-gray-700 placeholder-gray-500 border-gray-300 rounded-lg dark:border-gray-700 dark:placeholder-gray-400 dark:bg-gray-700 dark:text-white focus:placeholder-gray-500 focus:bg-white focus:outline-none focus:ring-1 focus:border-gray-800 focus:ring-gray-800 form-input dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text"
                    placeholder="Search enquiry number"
                    aria-label="Search" />
            </div>

            <!-- Time Filter Dropdown -->
            <select name="time_filter" onchange="this.form.submit()"
                class="flex-shrink-0 min-w-[130px] px-4 py-2 text-sm border border-gray-300 dark:border-gray-700 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <option value="today" {{ request('time_filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="1_week" {{ request('time_filter', '1_week') == '1_week' ? 'selected' : '' }}>1 Week Ago</option>
                <option value="1_month" {{ request('time_filter') == '1_month' ? 'selected' : '' }}>1 Month Ago</option>
            </select>

            <!-- Hidden fields to maintain pagination -->
            <input type="hidden" name="per_page" value="{{ request('per_page', 8) }}">
        </form>
    </div>

    <!-- Table -->
    <div class="w-full overflow-hidden bg-white px-4 py-5 dark:bg-gray-900">
        <div class="w-full overflow-x-auto">
            <table class="w-full border">
                <!-- Table Head -->
                <thead>
                    <tr class="text-sm font-semibold border tracking-wide text-black-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">SL No.</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Enquiry Number</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Company Name</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Received On</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Action</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center text-sm text-black dark:text-gray-400">
                    @forelse($recentEnquiries as $index => $enquiry)
                        <tr>
                            <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                {{ $recentEnquiries->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                {{ $enquiry->enquiry_number }}
                            </td>
                            <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                {{ $enquiry->user->company_name ?? $enquiry->user->name }}
                            </td>
                            <td class="px-4 py-3 text-sm border dark:border-gray-700">
                                {{ $enquiry->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 flex items-center justify-center dark:border-gray-700">
                                <a href="{{ route('seller.enquiries.show', $enquiry->id) }}"
                                   title="View Enquiry"
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
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-500">No enquiries found</p>
                                    <p class="text-sm text-gray-400">{{ request('search') ? 'Try adjusting your search terms' : 'New enquiries will appear here' }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($recentEnquiries->hasPages())
        <div class="grid px-0 bg-white rounded-b-lg sm:px-4 md:py-3 text-xs tracking-wide text-gray-500 border-t dark:border-gray-700 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800 gap-3">
            <!-- Navigation Links -->
            <span class="flex h-full items-center col-span-1 md:col-span-3 lg:col-span-3 mt-2 sm:mt-auto sm:justify-start">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center font-semibold">
                        {{-- Previous Button --}}
                        @if ($recentEnquiries->onFirstPage())
                            <li>
                                <span class="px-0 sm:px-3 py-1 rounded-md rounded-l-lg text-gray-300 cursor-not-allowed">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $recentEnquiries->previousPageUrl() }}"
                                   class="px-0 sm:px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-orange hover:bg-gray-100"
                                   aria-label="Previous">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($recentEnquiries->getUrlRange(1, $recentEnquiries->lastPage()) as $page => $url)
                            @if ($page == $recentEnquiries->currentPage())
                                <li>
                                    <span class="px-3 py-1 text-white transition-colors duration-150 bg-orange-500 border border-orange-500 rounded-md focus:outline-none focus:shadow-outline-orange">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-orange hover:bg-gray-100">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if ($recentEnquiries->hasMorePages())
                            <li>
                                <a href="{{ $recentEnquiries->nextPageUrl() }}"
                                   class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-orange hover:bg-gray-100"
                                   aria-label="Next">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="px-3 py-1 rounded-md rounded-r-lg text-gray-300 cursor-not-allowed">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </span>

            <span class="col-span-1 md:col-span-2 lg:col-span-2"></span>

            <!-- Results Info and Per Page Selector -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end col-span-12 md:col-span-12 lg:col-span-4 gap-2 sm:gap-4">
                <span class="font-semibold">
                    Showing {{ $recentEnquiries->firstItem() ?? 0 }} to {{ $recentEnquiries->lastItem() ?? 0 }} of {{ $recentEnquiries->total() }} entries
                </span>

                <!-- Per Page Dropdown -->
                <form method="GET" action="{{ route('seller.dashboard') }}" class="hidden md:flex">
                    <!-- Preserve other parameters -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('time_filter'))
                        <input type="hidden" name="time_filter" value="{{ request('time_filter') }}">
                    @endif

                    <select name="per_page" onchange="this.form.submit()"
                        class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-700 rounded-md text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 min-w-[110px]">
                        <option value="8" {{ request('per_page', 8) == 8 ? 'selected' : '' }}>Show 8</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>Show 10</option>
                        <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>Show 12</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>Show 20</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>Show 25</option>
                    </select>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
