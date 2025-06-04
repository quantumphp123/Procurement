@extends('customer.layouts.app')

@section('content')
    <section class="relative bg-cover bg-center h-80"
        style="background-image: url('{{ asset('frontend/assets/images/banner.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div
            class="absolute top-64 -translate-y-1/2 w-full px-4 sm:px-8 md:px-12 py-6 sm:py-8 flex flex-col items-start justify-center bg-gradient-to-r from-black via-indigo-500 to-transparent space-y-2">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                Enquiry Management
            </h1>
            <nav class="text-xs sm:text-sm text-white flex flex-wrap items-center space-x-1">
                <a href="#" class="hover:underline">Home</a>
                <span class="mx-1">›</span>
                <a href="#" class="hover:underline">Enquiry Management</a>
                <span class="mx-1">›</span>
                <span class="font-semibold">My Quotation</span>
            </nav>
        </div>
    </section>

    <section class="mb-10 mt-10">
        <div class="max-w-7xl mx-auto bg-white rounded-3xl overflow-hidden select-none"
            style="box-shadow: 0 0 15px rgb(0 0 0 / 0.1)">
            <!-- Top bar -->
            <div
                class="flex flex-col sm:flex-row items-center justify-between bg-[#EFF4FF] px-6 py-5 rounded-t-3xl gap-6 sm:gap-0 p-4">
                <div class="flex gap-6">
                    <button class="flex items-center gap-2 text-[#9ca3af] rounded-lg p-4 text-xl font-semibold leading-5"
                        onclick="window.location.href='{{ route('enquiry.management') }}'">
                        <img alt="Clipboard with upward arrow icon" class="w-5 h-5" height="20" loading="lazy"
                            src="{{ asset('frontend/assets/images/myEnquiryvectorgray.png') }}" width="20" />
                        My Enquiries
                    </button>
                    <button aria-current="page"
                        class="flex items-center gap-2 text-white  bg-[#3E57DA] text-xl font-normal leading-5 p-4 rounded-lg"
                        disabled="" onclick="window.location.href='{{ route('my.quotation') }}'">
                        <img alt="Envelope with dollar sign icon" class="w-5 h-5" height="20" loading="lazy"
                            src="{{ asset('frontend/assets/images/mailvectorwhite.png') }}  " width="20" />
                        My Quotations
                    </button>
                </div>
                <div class="relative rounded-2xl w-48 h-30 bg-gradient-to-r from-[#3b5de7] to-[#1a1c3d]  flex flex-col justify-center text-right px-6"
                    style="box-shadow: inset -20px 0 40px rgb(255 255 255 / 0.15)">
                    <div class="uppercase text-xs font-semibold tracking-widest leading-4 text-white">
                        Total Quotations
                    </div>
                    <div class="font-extrabold text-3xl leading-[38px] mt-2 text-white">
                        120
                    </div>
                    <div>
                        <select name="sort" id="sort"
                            class="text-gray-400 text-sm border-gray-400 border-2 p-1 rounded-full mt-2">
                            <option value="12">This Year</option>
                            <option value="30">This Month</option>
                            <option value="7">This Week</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Tabs and search -->
            <div class="flex flex-col sm:flex-row items-center justify-between px-20 pt-4 pb-4 border-b border-gray-200">
                <nav class="flex gap-8 text-sm font-normal leading-5">
                    <button aria-current="page" id="allBtn" onclick="showTab('all')"
                        class="text-[#3b5de7] font-semibold border-b-2 border-[#3b5de7] pb-1">
                        All Quotations
                    </button>
                    <button id="shortlistedBtn" onclick="showTab('shortlisted')" class="text-[#1f2937]">
                        Shortlisted
                    </button>
                    <button class="text-[#1f2937]">
                        Accepted
                    </button>
                    <button id="modifiedBtn" onclick="showTab('modified')" class="text-[#1f2937]">
                        Modified
                    </button>
                    <button class="text-[#1f2937]">
                        Rejected
                    </button>
                </nav>
                <form aria-label="Search enquiry number" class="mt-4 sm:mt-0 w-full sm:w-auto" role="search">
                    <label class="sr-only" for="search">
                        Search Enquiry number
                    </label>
                    <div
                        class="flex items-center border border-gray-300 rounded-full px-4 py-2 text-gray-400 text-sm leading-5">
                        <i class="fas fa-search mr-2 text-gray-400">
                        </i>
                        <input
                            class="bg-transparent focus:outline-none w-full text-xs text-gray-400 placeholder:text-gray-400"
                            id="search" name="search" placeholder="Search Enquiry number" type="search" />
                    </div>
                </form>
            </div>
            <!-- Table -->
            <div id="allTab" class="overflow-x-auto px-20 pt-4 pb-4">
                <table class="w-full text-xs text-[#1f2937]">
                    <thead>
                        <tr class="bg-[#ffe6b3] text-[#4b4b4b] font-semibold leading-5 text-left">
                            <th class="py-3 px-4 min-w-[60px]">
                                Sl.No
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                Enquiry Number
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                No. Quotations Submitted
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                Quotationed Date
                            </th>
                            <th class="py-3 px-4 min-w-[100px]">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                01
                            </td>
                            <td class="py-3 px-4 font-normal">
                                2344
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 01"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                    onclick="window.location.href='{{ route('view.quotation') }}'">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>

                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                02
                            </td>
                            <td class="py-3 px-4 font-normal">
                                2344
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 02"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div id="shortlistedTab" class="overflow-x-auto px-20 pt-4 pb-4 hidden">
                <table class="w-full text-xs text-[#1f2937]">
                    <thead>
                        <tr class="bg-[#ffe6b3] text-[#4b4b4b] font-semibold leading-5 text-left">
                            <th class="py-3 px-4 min-w-[60px]">
                                Sl.No
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                Enquiry Number
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                No. Quotations Submitted
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                Quotationed Date
                            </th>
                            <th class="py-3 px-4 min-w-[100px]">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                01
                            </td>
                            <td class="py-3 px-4 font-normal">
                                11111
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2027
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 01"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                    onclick="window.location.href='viewQuotation.html';">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>

                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                02
                            </td>
                            <td class="py-3 px-4 font-normal">
                                2344
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 02"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                03
                            </td>
                            <td class="py-3 px-4 font-normal">
                                2345
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 03"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                04
                            </td>
                            <td class="py-3 px-4 font-normal">
                                3562
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 04"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                2344
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 05"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                06
                            </td>
                            <td class="py-3 px-4 font-normal">
                                6754
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 06"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                07
                            </td>
                            <td class="py-3 px-4 font-normal">
                                8789
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 07"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                08
                            </td>
                            <td class="py-3 px-4 font-normal">
                                0987
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 08"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                09
                            </td>
                            <td class="py-3 px-4 font-normal">
                                7890
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 09"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                10
                            </td>
                            <td class="py-3 px-4 font-normal">
                                4567
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 10"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                11
                            </td>
                            <td class="py-3 px-4 font-normal">
                                4444
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 11"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                12
                            </td>
                            <td class="py-3 px-4 font-normal">
                                4321
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 12"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                13
                            </td>
                            <td class="py-3 px-4 font-normal">
                                4567
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 13"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-[#f0f5ff]">
                            <td class="py-3 px-4 font-normal">
                                14
                            </td>
                            <td class="py-3 px-4 font-normal">
                                8790
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 Feb 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 14"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="modifiedTab" class="overflow-x-auto px-20 pt-4 pb-4 hidden">
                <table class="w-full text-xs text-[#1f2937]">
                    <thead>
                        <tr class="bg-[#ffe6b3] text-[#4b4b4b] font-semibold leading-5 text-left">
                            <th class="py-3 px-4 min-w-[60px]">
                                Sl.No
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                Enquiry Number
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                No. Quotations Submitted
                            </th>
                            <th class="py-3 px-4 min-w-[140px]">
                                Quotationed Date
                            </th>
                            <th class="py-3 px-4 min-w-[100px]">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                01
                            </td>
                            <td class="py-3 px-4 font-normal">
                                11111
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2027
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 01"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                    onclick="window.location.href='viewQuotationModified.html';">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>

                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                01
                            </td>
                            <td class="py-3 px-4 font-normal">
                                1256
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 01"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                    onclick="window.location.href='viewQuotationModified.html';">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>

                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-3 px-4 font-normal">
                                01
                            </td>
                            <td class="py-3 px-4 font-normal">
                                11111
                            </td>
                            <td class="py-3 px-4 font-normal">
                                05
                            </td>
                            <td class="py-3 px-4 font-normal">
                                20 March 2025
                            </td>
                            <td class="py-3 px-4 flex gap-2">
                                <button aria-label="View enquiry 01"
                                    class="bg-[#3E57DA] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                    onclick="window.location.href='viewQuotationModified.html';">
                                    <i class="fas fa-eye text-xs">
                                    </i>
                                </button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Footer -->
            <div
                class="flex flex-col sm:flex-row items-center justify-between py-4 text-[11px] font-extrabold leading-4 text-[#1f2937] px-20 pt-4 pb-4">
                <div>
                    Showing 1–20 of 32 results
                </div>
                <nav aria-label="Pagination" class="flex items-center gap-2 mt-3 sm:mt-0">
                    <button aria-label="Previous page"
                        class="w-8 h-8 rounded-md bg-[#e2e8f0] text-[#6b7280] flex items-center justify-center">
                        <i class="fas fa-chevron-left">
                        </i>
                    </button>
                    <button aria-current="page"
                        class="w-8 h-8 rounded-md border border-[#d1d5db] text-[#1f2937] font-semibold">
                        1
                    </button>
                    <button aria-label="Page 2" class="w-8 h-8 rounded-md border border-[#d1d5db] text-[#1f2937]">
                        2
                    </button>
                    <span class="text-[#6b7280] font-semibold">
                        ...
                    </span>
                    <button aria-label="Page 13" class="w-8 h-8 rounded-md border border-[#d1d5db] text-[#1f2937]">
                        13
                    </button>
                    <button aria-label="Next page"
                        class="w-8 h-8 rounded-md bg-[#f9735b] text-white flex items-center justify-center">
                        <i class="fas fa-chevron-right">
                        </i>
                    </button>
                </nav>
            </div>
        </div>
    </section>
@endsection
