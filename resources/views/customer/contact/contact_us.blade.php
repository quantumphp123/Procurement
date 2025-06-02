@extends('customer.layouts.app')

@section('content')
    <section class="px-6 md:px-12 lg:px-24 py-16 bg-white mt-20">
        <!-- Toast Notification -->
        @if (session('success'))
            <div class="fixed top-4 right-4 z-50 animate-fade-in-down">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif



        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-2">Get in touch</h2>
            <p class="text-gray-500">We'd love to hear from you. Our friendly team is always here to chat.</p>
        </div>

        <!-- Contact Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto mb-10">
            <!-- Phone -->
            <div class="border rounded-xl p-6 shadow-md hover:shadow-lg transition group">
                <div class="flex items-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500 group-hover:text-indigo-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h2l3 7-2 4h2l1-3h6l1 3h2l-2-4 3-7h2" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Phone</h4>
                        <p class="text-sm text-gray-500">Mon–Fri from 8am to 5pm.</p>
                        <a href="tel:+1555000000"
                            class="text-blue-600 text-sm font-medium hover:underline mt-1 inline-block">+1 (555)
                            000-0000</a>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="border rounded-xl p-6 shadow-md hover:shadow-lg transition group">
                <div class="flex items-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500 group-hover:text-indigo-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12h2a2 2 0 002-2V7a2 2 0 00-2-2h-2m-4 0H8a2 2 0 00-2 2v3a2 2 0 002 2h4m4 4h2a2 2 0 002-2v-3a2 2 0 00-2-2h-2m-4 0H8a2 2 0 00-2 2v3a2 2 0 002 2h4" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Chat to us</h4>
                        <p class="text-sm text-gray-500">Our friendly team is here to help.</p>
                        <a href="mailto:hi@Protrade.com"
                            class="text-blue-600 text-sm font-medium hover:underline mt-1 inline-block">hi@Protrade.com</a>
                    </div>
                </div>
            </div>

            <!-- Office -->
            <div class="border rounded-xl p-6 shadow-md hover:shadow-lg transition group">
                <div class="flex items-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500 group-hover:text-indigo-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.656 0 3-1.567 3-3.5S13.656 4 12 4 9 5.567 9 7.5 10.344 11 12 11zM19 20v-1a2 2 0 00-2-2H7a2 2 0 00-2 2v1" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Office</h4>
                        <p class="text-sm text-gray-500">Come say hello at our office HQ.</p>
                        <p class="text-blue-600 text-sm font-medium mt-1">Ving 23, Galaxy Colony, Mumbai, 2nd floor</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Icons -->
        <div class="flex justify-center gap-4 mb-10 text-gray-500">
            <a href="#" class="hover:text-indigo-500"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="hover:text-indigo-500"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-indigo-500"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="hover:text-indigo-500"><i class="fab fa-youtube"></i></a>
        </div>

        <!-- Form -->
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-lg md:text-xl font-medium text-gray-800 mb-6">having questions ? Write to us</h3>
            <form action="{{ route('customer.contact-us.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name"
                            class="w-full border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('first_name') border-red-500 @enderror" />
                        @error('first_name')
                            <span class="text-red-500 text-sm mt-1 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name"
                            class="w-full border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('last_name') border-red-500 @enderror" />
                        @error('last_name')
                            <span class="text-red-500 text-sm mt-1 block text-left">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="w-full border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('email') border-red-500 @enderror" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 block text-left">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone number"
                        class="w-full border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('phone_number') border-red-500 @enderror" />
                    @error('phone_number')
                        <span class="text-red-500 text-sm mt-1 block text-left">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <textarea name="message" placeholder="Leave us a message..." rows="4"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-red-500 text-sm mt-1 block text-left">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-left">
                    <label class="inline-flex items-start space-x-2">
                        <input type="checkbox" name="privacy_policy_accepted" value="1"
                            class="mt-1 @error('privacy_policy_accepted') border-red-500 @enderror">
                        <span>You agree to our friendly <a href="#" class="text-orange-500 underline">Privacy
                                policy</a>.</span>
                    </label>
                    @error('privacy_policy_accepted')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-8 rounded-full transition">Get
                    In Touch</button>
            </form>
        </div>
    </section>

    @push('scripts')
        <script>
            // Auto-hide toast notification after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.querySelector('[role="alert"]');
                if (toast) {
                    setTimeout(() => {
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 300);
                    }, 5000);
                }
            });
        </script>
    @endpush
@endsection
