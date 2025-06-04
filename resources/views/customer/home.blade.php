@extends('customer.layouts.app')

@section('content')
    <div class="relative">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-black bg-opacity-50 h-[960px] sm:h-[960px] md:h-[760px] lg:h-[760px] xl:h-[760px]">
            <img src="{{ asset('frontend/assets/images/banner.jpg') }}" alt="Background Image"
                class="w-full h-[960px] sm:h-[960px] md:h-[760px] lg:h-[760px] xl:h-[760px] object-cover opacity-50">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent h-[960px] sm:h-[960px] md:h-[760px] lg:h-[760px] xl:h-[760px]"></div>
        <!-- Main Content -->
        <main class="relative z-10 pt-35 pb-20 text-center px-4">
            <h1 class="text-sm mx-auto rounded-2xl mb-5" style="background:white; color:#3E57DA; width:250px; padding:10px; ">
                #1 PLATFORM FOR GO WORLDWIDE</h1>
            <!-- Search Bar -->
            <div class="max-w-xl mx-auto mb-10">
                <div class="relative">
                    <input type="text"
                        class="w-full py-3 px-4 pl-12 bg-transparent bg-opacity-10 backdrop-blur-md  text-white rounded-full border border-white  focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Search for material" />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                </div>
            </div>

            <!-- Heading and Subheading -->
            <div class="max-w-4xl mx-auto mb-12">
                <h1 class="font-bold text-white mb-2 text-3xl sm:text-4xl md:text-5xl lg:text-[58px] sm:leading-8 md:leading-10 lg:leading-18">
                    Register with us to get products delivered to you <span class="text-orange-500 ">worldwide</span>
                </h1>
                <p class="text-lg text-white mt-6">
                    Browse product categories, post enquiries, and manage your procurement—all in one place.
                </p>
            </div>

            <!-- Feature Toggles -->
            <div class="flex flex-wrap justify-center gap-4 max-w-3xl mx-auto mb-16">
                <div class="bg-transparent border border-white rounded-full px-6 py-2 flex items-center space-x-2">
                    <span class="text-white font-bold">My Subscription</span>
                    <div class="w-12 h-12 bg-white rounded-full p-1 flex items-center justify-center">
                        <a href="#"><img src="{{ asset('frontend/assets/images/Img.png') }}" alt="right arrow"></a>
                    </div>
                </div>

                <div class="bg-transparent border border-white rounded-full px-6 py-2 flex items-center space-x-2">
                    <span class="text-white font-bold">Track Orders</span>
                    <div class="w-12 h-12 bg-white rounded-full p-1  flex items-center justify-center">
                        <a href="#"><img src="{{ asset('frontend/assets/images/Img.png') }}" alt="right arrow"></a>
                    </div>
                </div>

                <div class="bg-transparent border border-white rounded-full px-6 py-2 flex items-center space-x-2">
                    <span class="text-white font-bold">Create PO</span>
                    <div class="w-12 h-12 bg-white rounded-full p-1  flex items-center justify-center">
                        <a href="{{ route('submit.enquiry.form') }}"><img src="{{ asset('frontend/assets/images/Img.png') }}"
                                alt="right arrow"></a>
                    </div>
                </div>
            </div>


            <div class="mt-4 flex w-full">
                <!-- Left Text Section (30%) -->
                <div class="w-[30%] flex items-center pl-4 z-10">
                    <p class="text-white" style="font-size:16px;">Trusted by over 50,000 Sellers of all sizes</p>
                </div>

                <!-- Right Logo Marquee Section (70%) -->
                <div class="w-[70%] overflow-hidden">
                    <div class="flex animate-marquee whitespace-nowrap w-[200%]">
                        <!-- First loop -->
                        <div class="flex items-center space-x-8 w-full pr-8">
                            <span class="text-white text-xs uppercase font-bold">Bestseller</span>
                            <img src="{{ asset('frontend/assets/images/reuters.png') }}" alt="Reuters Logo"
                                class="h-12 " />
                            <img src="{{ asset('frontend/assets/images/teleperformance.png') }}" alt="Performance Logo"
                                class="h-12 " />
                            <img src="{{ asset('frontend/assets/images/zoom.png') }}" alt="Zoom Logo" class="h-12" />
                            <img src="{{ asset('frontend/assets/images/logo 2.png') }}" alt="Heineken Logo"
                                class="h-12" />
                            <img src="{{ asset('frontend/assets/images/dupont.png') }}" alt="DuPont Logo" class="h-12" />
                            <span class="text-white text-xs uppercase font-bold">Bestseller</span>
                        </div>
                        <!-- Duplicate for seamless scroll -->
                        <div class="flex items-center space-x-8 w-full pr-8">
                            <span class="text-white text-xs uppercase font-bold">Bestseller</span>
                            <img src="{{ asset('frontend/assets/images/reuters.png') }}" alt="Reuters Logo"
                                class="h-12" />
                            <img src="{{ asset('frontend/assets/images/teleperformance.png') }}" alt="Performance Logo"
                                class="h-12" />
                            <img src="{{ asset('frontend/assets/images/zoom.png') }}" alt="Zoom Logo" class="h-12" />
                            <img src="{{ asset('frontend/assets/images/logo 2.png') }}" alt="Heineken Logo"
                                class="h-12" />
                            <img src="{{ asset('frontend/assets/images/dupont.png') }}" alt="DuPont Logo" class="h-12 " />
                            <span class="text-white text-xs uppercase font-bold">Bestseller</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CSS -->
            <style>
                @keyframes marquee {
                    0% {
                        transform: translateX(0%);
                    }

                    100% {
                        transform: translateX(-50%);
                    }
                }

                .animate-marquee {
                    animation: marquee 20s linear infinite;
                }
            </style>

        </main>

    </div>
    <!-- Product Categories Section -->
    <section class="mt-8 mx-auto px-8 py-8" style="max-width: 1300px;">
        <!-- Header -->
        <div class="text-blue-600 text-sm font-medium mb-2">
            <span class="bg-gradient-reverse p-2 rounded-xl">TOP PRODUCTS LISTED !</span>
        </div>

        <!-- Title and Explore All Button Row -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Select Category & Continue</h2>
            <a href="#" class="flex items-center text-orange-500 hover:text-orange-600">
                Explore All Categories
                <span class="ml-1 bg-orange-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
            </a>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="rounded-lg overflow-hidden shadow-md relative h-80 group cursor-pointer">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                        <div class="p-6 w-full flex justify-center items-center backdrop-blur-xs">
                            <h3 class="text-white text-xl font-semibold px-3">{{ $category->name }}</h3>
                            <span class="text-white bg-black/20 rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <div class="flex justify-center mt-8 gap-4">
            <button
                class="w-12 h-12 rounded-full bg-orange-500 text-white flex items-center justify-center shadow-md hover:bg-orange-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button
                class="w-12 h-12 rounded-full bg-orange-500 text-white flex items-center justify-center shadow-md hover:bg-orange-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </section>
    <!-- Procurement Enquiry Banner Section -->
    <!-- Procurement Enquiry Section -->
    <section class="max-w-7xl mx-auto px-4 py-8">
        <div class="relative w-full rounded-xl overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('frontend/assets/images/banner1.jpg') }}"
                    alt="B
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black/50">
            </div>
        </div>

        <!-- Content Container -->
        <div
            class="relative z-10 px-6 md:px-10 py-10 md:py-12 flex flex-col md:flex-row items-start md:items-center justify-between">
            <!-- Text Content -->
            <div class="mb-6 md:mb-0">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Post procurement enquiry</h2>
                <p class="text-white/90 text-base md:text-lg max-w-xl">
                    Want Request PO with sellers? Submit your order request and negotiate unbeatable prices.
                </p>
            </div>

            <!-- CTA Button -->
            <a href="{{ route('submit.enquiry.form') }}"
                class="color hover:bg-orange-500 transition-colors text-white font-medium rounded-full px-6 py-3 flex items-center space-x-2 whitespace-nowrap">
                <span>Post an Enquiry</span>
                <div class="bg-white rounded-full w-8 h-8">
                    <img src="{{ asset('frontend/assets/images/Img.png') }}" alt="right arrow" class="w-8 h-8">
                </div>
            </a>
        </div>
        </div>
    </section>
    <!-- Features Section -->
    <section class="bg-gradient py-16 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 lg:gap-16">
                <!-- Left Content - Features List -->
                <div class="w-full md:w-1/2">
                    <!-- Features Header Badge -->
                    <div
                        class="inline-block px-4 py-1 bg-white rounded-xl text-blue-600 text-sm font-medium mb-6 shadow-sm">
                        FEATURES & WHAT WE PROVIDE!
                    </div>

                    <!-- Main Heading -->
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 leading-tight">
                        Key feature about<br>ProTrade platform
                    </h2>

                    <!-- Features List -->
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 mt-1 color rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-3 text-lg text-gray-700">Get verified suppliers all over world</span>
                        </li>

                        <li class="flex items-start">
                            <span class="flex-shrink-0 mt-1 color rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-3 text-lg text-gray-700">Get instant quotations from multiple suppliers.</span>
                        </li>

                        <li class="flex items-start">
                            <span class="flex-shrink-0 mt-1 color rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-3 text-lg text-gray-700">Directly negotiate prices and clarify details with
                                suppliers.</span>
                        </li>

                        <li class="flex items-start">
                            <span class="flex-shrink-0 mt-1 color rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-3 text-lg text-gray-700">Make safe and flexible payments through the
                                platform.</span>
                        </li>

                        <li class="flex items-start">
                            <span class="flex-shrink-0 mt-1 color rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-3 text-lg text-gray-700">Track your orders in real-time from dispatch to
                                delivery.</span>
                        </li>
                    </ul>
                </div>

                <!-- Right Content - Image -->
                <div class="w-full md:w-1/2 mt-8 md:mt-0">
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ asset('frontend/assets/images/Container.png') }}"
                            alt="Business people joining hands in teamwork" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="relative max-w-7xl mx-auto rounded-4xl mt-10 mb-10 flex items-center justify-center bg-cover bg-center bg-no-repeat px-4 sm:px-8" style="background-image: url('{{ asset('frontend/assets/images/test.jpg') }}'); min-height: 22em; height: 30em;">
        <div class="absolute inset-0 bg-white/50"></div>
      
        <div class="relative z-10 text-center max-w-4xl w-full px-2 sm:px-4 py-8 sm:py-12">
          <h2 class="text-orange-400 text-lg sm:text-xl font-bold uppercase mb-4 sm:mb-6 tracking-wide">What Our Customers Say</h2>
      
          <p class="text-black text-base sm:text-xl md:text-2xl font-semibold leading-relaxed mb-6 sm:mb-10" style="font-size:18px;">
            My <span class="text-black font-bold">"TradePro"</span> experience was nothing short of incredible.<br class="hidden sm:block">
            The procurement service made my experience unforgettable. I'll be back for more!
          </p>
      
          <div class="flex justify-center items-center mb-3 sm:mb-4">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Aleea Thompson" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full border-4 border-white shadow-lg">
          </div>
      
          <p class="text-black text-base sm:text-lg font-bold">Aleea Thompson</p>
      
          <!-- Navigation arrows -->
          <div class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2">
            <button aria-label="Previous testimonial" class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-[#FF7A59] text-white hover:bg-[#ff8f72] transition">
              <i class="fas fa-arrow-left text-xs"></i>
            </button>
          </div>
      
          <div class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2">
            <button aria-label="Next testimonial" class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-[#FF7A59] text-white hover:bg-[#ff8f72] transition">
              <i class="fas fa-arrow-right text-xs"></i>
            </button>
          </div>
        </div>
      </section>
    @include('customer.auth.signin-modal')
@endsection
