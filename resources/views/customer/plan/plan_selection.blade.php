@extends('customer.layouts.app')

@section('content')
    @if (!auth()->check())
        @include('customer.auth.signin-modal')
    @endif

    <section class="relative bg-cover bg-center"
        style="background-image: url('{{ asset('frontend/assets/images/banner.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative max-w-6xl mx-auto px-1 py-30 text-white">
            <h2 class="text-3xl md:text-5xl font-bold mb-4 mt-10">
                Select Your Plan to Get Started!
            </h2>
            <p class="text-lg md:text-xl text-gray-200">
                Choose the perfect plan for your business needs. Start with a 30-day trial.
            </p>
        </div>
    </section>

    <section class="text-center py-12 px-4">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-2">Find your perfect plan</h2>
        <p class="text-sm md:text-base text-gray-500 mb-10">
            @if (session('trial_starts_at'))
                Your 30-day trial period starts today and ends on
                {{ \Carbon\Carbon::parse(session('trial_ends_at'))->format('M d, Y') }}
            @else
                All plans include a 30-day trial period. You can upgrade or cancel anytime.
            @endif
        </p>

        @if (session('message'))
            <div
                class="mb-6 p-4 rounded-lg {{ session('alert-type') === 'success' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                {{ session('message') }}
            </div>
        @endif

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
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
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
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
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
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
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
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Access to Introductory GST Modules (Basics, Registration, Taxable Supplies).
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
                        </span>
                        Up to 5 interactive modules per month.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-blue-600 w-7 h-7 rounded-full flex items-center justify-center shrink-0">
                            <img src="{{ asset('frontend/assets/images/tick-svgrepo-com.svg') }}" alt="Tick"
                                class="w-4 h-4" />
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
    </section>

    @push('scripts')
        <script>
            function selectPlan(plan) {
                @if (!auth()->check())
                    // Show signin modal if user is not logged in
                    document.getElementById('signin-modal').classList.remove('hidden');
                    document.getElementById('signin-modal').classList.add('flex');
                @else
                    // If user is logged in, proceed with plan selection
                    updatePlan(plan);
                @endif
            }

            function updatePlan(plan) {
                // Show loading state
                const buttons = document.querySelectorAll('button');
                buttons.forEach(button => button.disabled = true);

                // Add AJAX call to update user's plan
                fetch('{{ route('customer.update.plan') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            plan: plan
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message using toastr
                            toastr.success(data.message);

                            // Redirect after a short delay
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 2000);
                        } else {
                            // Show error message using toastr
                            toastr.error(data.message || 'Failed to update plan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastr.error('Failed to update plan. Please try again.');
                    })
                    .finally(() => {
                        // Re-enable buttons
                        buttons.forEach(button => button.disabled = false);
                    });
            }

            // Check plan status on page load
            @if (auth()->check())
                fetch('{{ route('customer.plan.status') }}')
                    .then(response => response.json())
                    .then(data => {
                        // Show appropriate message based on plan status
                        if (data.plan_expired) {
                            const expiredMessage = document.createElement('div');
                            expiredMessage.className = 'mb-6 p-4 rounded-lg bg-red-100 text-red-700';
                            expiredMessage.textContent = 'Your plan has expired. Please select a new plan to continue.';
                            document.querySelector('section.text-center').insertBefore(
                                expiredMessage,
                                document.querySelector('.grid')
                            );
                        } else if (data.is_trial_active) {
                            const trialInfo = document.createElement('div');
                            trialInfo.className = 'mb-6 p-4 rounded-lg bg-blue-100 text-blue-700';
                            const daysLeft = Math.max(0, moment(data.trial_ends_at).diff(moment(), 'days'));
                            trialInfo.textContent = `Your trial period ends in ${daysLeft} days`;
                            document.querySelector('section.text-center').insertBefore(
                                trialInfo,
                                document.querySelector('.grid')
                            );
                        } else if (data.current_plan) {
                            const planInfo = document.createElement('div');
                            planInfo.className = 'mb-6 p-4 rounded-lg bg-green-100 text-green-700';
                            const daysLeft = Math.max(0, moment(data.plan_expires_at).diff(moment(), 'days'));
                            planInfo.textContent = `Your ${data.current_plan} plan is active. ${daysLeft} days remaining.`;
                            document.querySelector('section.text-center').insertBefore(
                                planInfo,
                                document.querySelector('.grid')
                            );
                        }
                    })
                    .catch(error => console.error('Error checking plan status:', error));
            @endif
        </script>
    @endpush
@endsection
