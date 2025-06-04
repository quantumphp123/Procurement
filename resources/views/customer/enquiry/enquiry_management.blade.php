@extends('customer.layouts.app')

@section('content')
    <section class="relative bg-center bg-cover h-80"
        style="background-image: url('{{ asset('frontend/assets/images/banner.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div
            class="absolute flex flex-col items-start justify-center w-full px-4 py-6 space-y-2 -translate-y-1/2 top-64 sm:px-8 md:px-12 sm:py-8 bg-gradient-to-r from-black via-indigo-500 to-transparent">
            <h1 class="text-2xl font-bold text-white sm:text-3xl md:text-4xl">
                Enquiry Management
            </h1>
            <nav class="flex flex-wrap items-center space-x-1 text-xs text-white sm:text-sm">
                <a href="#" class="hover:underline">Home</a>
                <span class="mx-1">›</span>
                <a href="#" class="hover:underline">Enquiry Management</a>
                <span class="mx-1">›</span>
                <span class="font-semibold">My Enquiries</span>
            </nav>
        </div>
    </section>

    <section class="mt-10 mb-10">
        <div class="mx-auto overflow-hidden bg-white select-none max-w-7xl rounded-3xl"
            style="box-shadow: 0 0 15px rgb(0 0 0 / 0.1)">
            @livewire('customer.enquiry-management')
        </div>
    </section>
@endsection
