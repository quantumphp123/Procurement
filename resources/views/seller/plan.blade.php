@extends('seller.layouts.seller')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        .plan-card {
            transition: all 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .modal {
            backdrop-filter: blur(5px);
        }
    </style>

    <!-- Main Content -->
    <section class="text-center py-12 px-4">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-2">Find your perfect plan</h2>
        <p class="text-sm md:text-base text-gray-500 mb-10">All plans auto-renew monthly. You can upgrade, or cancel anytime
            from the profile settings.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <!-- Free Plan -->
            <div
                class="group bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col justify-between p-6 transition-all duration-300 hover:bg-black hover:text-white">

                <!-- Plan Header -->
                <div>
                    <h3 class="text-3xl font-semibold text-gray-900 group-hover:text-white mb-1">Free Plan</h3>
                    <p class="text-sm text-gray-500 group-hover:text-gray-300 mb-4">Perfect for beginners and casual
                        learners.</p>
                    <div class="text-5xl font-bold text-gray-900 group-hover:text-white mb-1">
                        $0 <span class="text-base font-medium text-gray-600 group-hover:text-gray-300">/ 1 Month</span>
                    </div>
                </div>

                <!-- Feature List -->
                <ul class="mt-6 space-y-4 text-sm text-gray-700 group-hover:text-white">
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to basic Yes/No pathway questions and explanations.
                    </li>
                </ul>

                <!-- CTA Button -->
                <button onclick="selectPlan('free')"
                    class="mt-6 w-full text-orange-500 border border-orange-400 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                    Get Started
                </button>

            </div>

            <!-- Basic Plan -->
            <div
                class="group bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col justify-between p-6 transition-all duration-300 hover:bg-black hover:text-white">

                <!-- Plan Header -->
                <div>
                    <h3 class="text-3xl font-semibold text-gray-900 group-hover:text-white mb-1">Basic Plan</h3>
                    <p class="text-sm text-gray-500 group-hover:text-gray-300 mb-4">Perfect for beginners and casual
                        learners.</p>
                    <div class="text-5xl font-bold text-gray-900 group-hover:text-white mb-1">
                        $7.99 <span class="text-base font-medium text-gray-600 group-hover:text-gray-300">/ 1 Month</span>
                    </div>
                </div>

                <!-- Feature List -->
                <ul class="mt-6 space-y-4 text-sm text-gray-700 group-hover:text-white">
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to basic Yes/No pathway questions and explanations.
                    </li>
                </ul>

                <!-- CTA Button -->
                <button onclick="selectPlan('basic')"
                    class="mt-6 w-full text-orange-500 border border-orange-400 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                    Get Started
                </button>

            </div>

            <!-- Standard Plan -->
            <div
                class="group bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col justify-between p-6 transition-all duration-300 hover:bg-black hover:text-white">

                <!-- Plan Header -->
                <div>
                    <h3 class="text-3xl font-semibold text-gray-900 group-hover:text-white mb-1">Standard Plan</h3>
                    <p class="text-sm text-gray-500 group-hover:text-gray-300 mb-4">Perfect for beginners and casual
                        learners.</p>
                    <div class="text-5xl font-bold text-gray-900 group-hover:text-white mb-1">
                        $10.99 <span class="text-base font-medium text-gray-600 group-hover:text-gray-300">/ 1 Month</span>
                    </div>
                </div>

                <!-- Feature List -->
                <ul class="mt-6 space-y-4 text-sm text-gray-700 group-hover:text-white">
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to basic Yes/No pathway questions and explanations.
                    </li>
                </ul>

                <!-- CTA Button -->
                <button onclick="selectPlan('standard')"
                    class="mt-6 w-full text-orange-500 border border-orange-400 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                    Get Started
                </button>

            </div>

            <!-- Premium Plan -->
            <div
                class="group bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col justify-between p-6 transition-all duration-300 hover:bg-black hover:text-white">

                <!-- Plan Header -->
                <div>
                    <h3 class="text-3xl font-semibold text-gray-900 group-hover:text-white mb-1">Premium Plan</h3>
                    <p class="text-sm text-gray-500 group-hover:text-gray-300 mb-4">Perfect for beginners and casual
                        learners.</p>
                    <div class="text-5xl font-bold text-gray-900 group-hover:text-white mb-1">
                        $99.99 <span class="text-base font-medium text-gray-600 group-hover:text-gray-300">/ 1 Month</span>
                    </div>
                </div>

                <!-- Feature List -->
                <ul class="mt-6 space-y-4 text-sm text-gray-700 group-hover:text-white">
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{asset('img/icons/tick-svgrepo-com.svg')}}" alt="Tick" class="w-4 h-4" />
                        </span>
                        Access to basic Yes/No pathway questions and explanations.
                    </li>
                </ul>

                <!-- CTA Button -->
                <button onclick="selectPlan('premium')"
                    class="mt-6 w-full text-orange-500 border border-orange-400 hover:bg-orange-50 py-2 rounded-full font-medium transition-colors duration-200 group-hover:text-orange-300">
                    Get Started
                </button>

            </div>
        </div>

        <!-- Skip Option - Now properly centered -->
        <div class="text-center mt-8">
            <button onclick="skipPlan()" class="text-gray-600 hover:text-gray-800 font-medium underline">
                Skip for now (Choose later from dashboard)
            </button>
        </div>
    </section>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="backdrop-filter: blur(5px);">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl text-center mx-4">
            <img src="{{ asset('img/icons/Illustration.svg')}}"
                 alt="Success icon with confetti"
                 class="w-44 h-44 mb-6 mx-auto drop-shadow-lg">

            <h1 class="text-2xl font-semibold text-black mb-2" style="font-family: 'Poppins', sans-serif;">
                Congratulations!
            </h1>

            <p class="text-sm text-gray-500 px-4 mb-8" id="modalMessage">
                Your account has been created successfully!
            </p>

            <button onclick="goToDashboard()"
                    class="w-full py-3 text-sm font-semibold text-white bg-[#f87171] rounded-full hover:bg-[#f87171cc] transition-colors">
                Go to Dashboard
            </button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showSuccessModal(message = 'Your account has been created successfully!') {
            document.getElementById('modalMessage').textContent = message;
            document.getElementById('successModal').classList.remove('hidden');
            document.getElementById('successModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
            document.getElementById('successModal').classList.remove('flex');
        }

        function goToDashboard() {
            window.location.href = '{{ route("seller.dashboard") }}';
        }

        function selectPlan(planType) {
            // Show success modal when plan is selected
            showSuccessModal(`Great! You've selected the ${planType} plan. Welcome aboard!`);
        }

        function skipPlan() {
            // Show success modal when skipping
            showSuccessModal('Account created successfully! You can choose a plan later from your dashboard.');
        }

        // Auto show modal if session has success message
        @if(session('registration_success') || session('show_success_modal'))
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessModal();
            });
        @endif
    </script>
@endpush
