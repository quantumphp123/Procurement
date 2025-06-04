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
                <span class="font-semibold">My Enquiries</span>
            </nav>
        </div>
    </section>

    <section class="mb-10 mt-10">
        <div class="max-w-7xl mx-auto bg-white rounded-3xl overflow-hidden select-none"
            style="box-shadow: 0 0 15px rgb(0 0 0 / 0.1)">
            @livewire('customer.enquiry-management')
        </div>
    </section>
@endsection
