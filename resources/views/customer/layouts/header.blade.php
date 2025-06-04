<header class="fixed z-20 top-0 left-0 right-0 bg-white rounded-full shadow-md mx-auto max-w-6xl mt-2 px-4">
    <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="{{ route('website') }}">
                <div class="bg-gray-900 text-white font-bold py-3 px-6 rounded-full">
                    <span>Pro<span class="text-blue-500">Trade</span> <span class="text-blue-500 text-xs"></span></span>
                    <!-- <div class="bg-blue-500 w-1 h-1 rounded-full "></div> -->
                </div>
            </a>
        </div>

        <!-- Desktop Nav -->
        <!-- Desktop Nav -->
        <nav class="hidden md:flex space-x-8">
            <a href="{{ route('website') }}" class="nav-link text-gray-500">Home</a>
            <a href="{{ route('enquiry.management') }}" class="nav-link text-gray-500">Enquiry Management</a>
            <a href="{{ route('customer.my.orders') }}" class="nav-link text-gray-500">My Orders</a>
            <a href="#" class="nav-link text-gray-500">Help</a>
            <a href="{{ route('customer.contact.us') }}" class="nav-link text-gray-500">Contact Us</a>
        </nav>



        <div class="hidden md:flex">
            @if (auth()->check())
                <div class="relative group">
                    <div class="flex items-center gap-2 bg-white text-orange-500 border border-orange-500 font-medium rounded-full px-4 py-2 text-sm cursor-pointer group-hover:bg-orange-50"
                        id="user-menu-toggle">
                        Hey, {{ auth()->user()->customer->contact_person_name ?? 'User' }}
                        <img src="{{ auth()->user()->profile_pic ? asset('storage/' . auth()->user()->profile_pic) : asset('frontend/assets/images/icons8-user-32.png') }}" alt="User Icon"
                            class="w-5 h-5 rounded-full object-cover" />
                        <svg class="w-4 h-4 ml-1 text-orange-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <div class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-xl shadow-lg py-4 z-50 hidden group-hover:block"
                        id="user-menu-dropdown">
                        <div class="px-6 pb-4 border-b border-gray-100">
                            <div class="font-semibold text-lg text-gray-800">
                                {{ auth()->user()->customer->company_name ?? 'Company Name' }}</div>
                            <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('customer.company.details') }}"
                                class="flex items-center px-6 py-3 hover:bg-orange-50 transition rounded-lg">
                                <svg class="w-5 h-5 mr-3 text-orange-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 010 7.75" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span class="text-gray-700 font-medium">Company Details</span>
                            </a>
                            <a href="#"
                                class="flex items-center px-6 py-3 hover:bg-orange-50 transition rounded-lg">
                                <svg class="w-5 h-5 mr-3 text-orange-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span class="text-gray-700 font-medium">Settings</span>
                            </a>
                        </div>
                        <form method="POST" action="{{ route('customer.logout') }}" class="px-6 pt-2">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 justify-center px-4 py-2 text-red-500 text-base font-semibold rounded-lg hover:bg-red-50 transition">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M17 16l4-4m0 0l-4-4m4 4H7" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M3 12a9 9 0 0118 0 9 9 0 01-18 0z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <button id="login-toggle-btn"
                    class="flex items-center gap-2 bg-white hover:bg-gray-100 text-orange-500 border border-orange-500 font-medium rounded-full px-4 py-2 text-sm">
                    Login/Register
                    <img src="{{ auth()->user()->profile_pic ? asset('storage/' . auth()->user()->profile_pic) : asset('frontend/assets/images/icons8-user-32.png') }}" alt="User Icon"
                        class="w-5 h-5 rounded-full" />
                </button>
            @endif
        </div>

        <!-- Login Dropdown Box -->
        <div id="login-box" class="hidden absolute top-20 right-5 sm:right-10 z-10">
            <div class="bg-white rounded-md shadow-lg p-4 w-64">
                <button id="dropdown-login-btn"
                    class="w-full bg-orange-50 text-orange-600 font-medium py-2 px-4 rounded-full border border-orange-500 hover:bg-orange-100 flex items-center justify-center gap-2">
                    Login
                    <img src="{{ asset('frontend/images/Arrow.png') }}" alt="" />
                </button>
                <div class="text-center my-2 text-gray-500">or</div>
                <div class="text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('customer.register') }}" class="text-orange-500 font-medium">Register</a>
                </div>
            </div>
        </div>

        <!-- Hamburger Icon -->
        <div class="md:hidden">
            <button id="menu-btn" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    <div id="mobile-menu"
        class="md:hidden hidden fixed top-20 left-1/2 transform -translate-x-1/2 w-full max-w-5xl bg-white rounded-xl shadow-md px-6 py-4 z-20">
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('website') }}" class="text-blue-600">Home</a>
            <a href="{{ route('enquiry.management') }}" class="text-gray-500">Enquiry Management</a>
            <a href="{{ route('customer.my.orders') }}" class="text-gray-500">My Orders</a>
            <a href="#" class="text-gray-500">Help</a>
            <a href="{{ route('customer.contact.us') }}" class="text-gray-500">Contact Us</a>

            @auth
                <div class="flex flex-col space-y-2 border-t border-gray-200 pt-2 mt-2">
                    <a href="{{ route('customer.company.details') }}" class="text-gray-700 font-medium">Hey, {{ auth()->user()->customer->contact_person_name ?? 'User' }}</a>
                    <form method="POST" action="{{ route('customer.logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 font-medium">Logout</button>
                    </form>
                </div>
            @endauth

            @guest
                <button
                    id="login-toggle-btn-mobile"
                    class="mt-2 flex items-center justify-center gap-2 bg-white hover:bg-gray-100 text-orange-500 border border-orange-500 font-medium rounded-full px-4 py-2 text-sm">
                    Login/Register
                    <img src="{{ auth()->user()->profile_pic ? asset('storage/' . auth()->user()->profile_pic) : asset('frontend/assets/images/icons8-user-32.png') }}" alt="User Icon" class="w-5 h-5 rounded-full">
                </button>
            @endguest
        </nav>
    </div>
</header>

<script>
    // Optional: For click-to-toggle on small screens
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('user-menu-toggle');
        const dropdown = document.getElementById('user-menu-dropdown');
        if (toggle && dropdown) {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hamburger menu toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const loginToggleBtn = document.getElementById('login-toggle-btn');
        const loginBox = document.getElementById('login-box');
        const dropdownLoginBtn = document.getElementById('dropdown-login-btn');
        const signinModal = document.getElementById('signin-modal');

        // Login button click handlers
        if (loginToggleBtn) {
            loginToggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (signinModal) {
                    signinModal.classList.remove('hidden');
                    signinModal.classList.add('flex');
                }
                if (loginBox) {
                    loginBox.classList.toggle('hidden');
                }
            });
        }

        // Dropdown login button handler
        if (dropdownLoginBtn && signinModal) {
            dropdownLoginBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                signinModal.classList.remove('hidden');
                signinModal.classList.add('flex');
                if (loginBox) {
                    loginBox.classList.add('hidden');
                }
            });
        }

        // Close modal when clicking outside
        if (signinModal) {
            signinModal.addEventListener('click', function(e) {
                if (e.target === signinModal) {
                    signinModal.classList.add('hidden');
                    signinModal.classList.remove('flex');
                }
            });
        }

        // Hamburger menu handlers
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }

        // Close dropdown if clicking outside
        document.addEventListener('click', function(e) {
            if (loginBox && !loginBox.contains(e.target) && !loginToggleBtn.contains(e.target)) {
                loginBox.classList.add('hidden');
            }
        });
    });
</script>
</header>
