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
                <span class="font-semibold">View Quotations</span>
            </nav>
        </div>
    </section>
    <section>
        <div class="px-16 mt-14 mb-14">
            <h1 class="text-3xl font-bold leading-14">Quotation Received</h1>
            <h6 class="text-2xl">Submit Required Details in below table</h6>
        </div>
        <div class="max-w-7xl mx-auto mt-5 mb-5 p-8 shadow-md  bg-white rounded-2xl">
            <h1 class="text-lg inline-block">Enquiry Number:</h1>
            <span class="bg-[#EBECED] px-10 py-1 text-lg border-gray-300 rounded">1234</span>
        </div>
        <div class="max-w-7xl mx-auto rounded-2xl overflow-hidden border border-transparent mb-10 shadow-md ">
            <table class="w-full border-collapse rounded-2xl overflow-hidden">
                <thead>
                    <tr class="bg-[#FFE5B4]">
                        <th class="text-left font-bold text-sm py-3 px-6 border border-[#FFE5B4]">Sl.No</th>
                        <th class="text-left font-bold text-sm py-3 px-6 border border-[#FFE5B4]">Seller’s Name</th>
                        <th class="text-center font-bold text-sm py-3 px-6 border border-[#FFE5B4]">Action</th>
                        <th class="text-left font-bold text-sm py-3 px-6 border border-[#FFE5B4]">Document</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100">
                        <td class="text-xs font-normal py-4 px-6">01</td>
                        <td class="text-xs font-normal py-4 px-6">John Doe</td>
                        <td class="text-center py-4 px-6">
                            <button class="bg-[#3B4CCA] text-white rounded-md p-2"
                                onclick="window.location.href='{{ route('view.quotation') }}'">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </td>
                        <td class="text-xs font-normal py-4 px-6 text-[#D94A3B] underline cursor-pointer"
                            onclick="document.getElementById('signin-modal').classList.remove('hidden')">View Doc</td>
                    </tr>
                    <tr class="border-b border-gray-100">
                        <td class="text-xs font-normal py-4 px-6">01</td>
                        <td class="text-xs font-normal py-4 px-6">John Doe</td>
                        <td class="text-center py-4 px-6">
                            <button class="bg-[#3B4CCA] text-white rounded-md p-2"
                                onclick="window.location.href='{{ route('view.quotation') }}'">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </td>
                        <td class="text-xs font-normal py-4 px-6 text-[#D94A3B] underline cursor-pointer"
                            onclick="document.getElementById('signin-modal1').classList.remove('hidden')">Request Doc</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>
@endsection
