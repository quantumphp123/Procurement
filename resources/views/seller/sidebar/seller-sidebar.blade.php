<!-- Desktop sidebar -->
<aside style="width: 260px;"
    class="z-20 hidden overflow-y-auto px-6 border dark:border-gray-700 bg-white dark:bg-gray-800 md:flex justify-between flex-shrink-0 flex-col">
    <div class="py-4 text-gray-800 dark:text-gray-400">
        <a href="#">
            <div class="dark:bg-cool-gray-800 bg-gray-900 text-white py-3 rounded-full">
                <span class="flex justify-center">
                    <img src="{{ asset('img/logo.svg') }}" alt="logo">
                </span>
            </div>
        </a>
        <ul class="mt-6">
            <!-- Dashboard -->
            <li class="relative py-2">
                <a href="{{ route('seller.dashboard') }}"
                    class="icon-link {{ request()->routeIs('seller.dashboard', 'seller.upgrade.plan') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/dashboard.svg') }}"
                    data-hover="{{ asset('img/icons/dashboard-h.svg') }}"
                    data-active="{{ asset('img/icons/dashboard-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.dashboard', 'seller.upgrade.plan') ? asset('img/icons/dashboard-h.svg') : asset('img/icons/dashboard.svg') }}"
                        alt="Dashboard icon" height="20" class="icon w-5 h-5">
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Enquiries -->
            <li class="relative py-2">
                <a href="{{ route('seller.enquiries.index') }}"
                    class="icon-link {{ request()->routeIs('seller.enquiries.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/enquiries.svg') }}"
                    data-hover="{{ asset('img/icons/enquiries-h.svg') }}"
                    data-active="{{ asset('img/icons/enquiries-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.enquiries.*') ? asset('img/icons/enquiries-h.svg') : asset('img/icons/enquiries.svg') }}"
                        height="20" alt="Enquiries icon">
                    <span>Enquires</span>
                </a>
            </li>

            <!-- Modified Requests -->
            <li class="relative py-2">
                <a href="{{ route('seller.modified-orders.index') }}"
                    class="icon-link {{ request()->routeIs('seller.modified-orders.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/timer.svg') }}"
                    data-hover="{{ asset('img/icons/timer-h.svg') }}"
                    data-active="{{ asset('img/icons/timer-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.modified-orders.*') ? asset('img/icons/timer-h.svg') : asset('img/icons/timer.svg') }}"
                        alt="Modified requests icon">
                    <span>Modified Requests</span>
                </a>
            </li>

            <!-- My Orders -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.orders.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/my-orders.svg') }}"
                    data-hover="{{ asset('img/icons/my-orders-h.svg') }}"
                    data-active="{{ asset('img/icons/my-orders-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.orders.*') ? asset('img/icons/my-orders-h.svg') : asset('img/icons/my-orders.svg') }}"
                        alt="Orders icon">
                    <span>My Orders</span>
                </a>
            </li>

            <!-- Customers -->
            <li class="relative py-2">
                <a href="{{ route('seller.customers.index') }}"
                    class="icon-link {{ request()->routeIs('seller.customers.index') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/customers.svg') }}"
                    data-hover="{{ asset('img/icons/customer-h.svg') }}"
                    data-active="{{ asset('img/icons/customer-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.customers.index') ? asset('img/icons/customer-h.svg') : asset('img/icons/customers.svg') }}"
                        alt="customers icon">
                    <span>Customers</span>
                </a>
            </li>

            <!-- Documents -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.documents.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/documents.svg') }}"
                    data-hover="{{ asset('img/icons/documents-h.svg') }}"
                    data-active="{{ asset('img/icons/documents-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.documents.*') ? asset('img/icons/documents-h.svg') : asset('img/icons/documents.svg') }}"
                        height="20" alt="documents icon">
                    <span>Documents</span>
                </a>
            </li>

            <!-- My Products -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.products.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg"
                    data-default="{{ asset('img/icons/product.svg') }}"
                    data-hover="{{ asset('img/icons/product-h.svg') }}"
                    data-active="{{ asset('img/icons/product-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.products.*') ? asset('img/icons/product-h.svg') : asset('img/icons/product.svg') }}"
                        alt="product icon">
                    <span>My Products</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="mb-5 text-gray-800">
        <ul>
            {{--  <li class="relative py-2">
                   <a href="#"
                       class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-200 hover:text-orange-500 dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-lg">
                       <span class="flex gap-3">
                           <img src="{{ asset('img/icons/help.svg') }}" alt="help icon"> Help Center
                       </span>
                       <span
                           class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full dark:text-red-100 dark:bg-red-600">
                           8
                       </span>
                   </a>
               </li>  --}}
            <!-- Password & Security -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.security.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/settings.svg') }}"
                    data-hover="{{ asset('img/icons/settings-h.svg') }}"
                    data-active="{{ asset('img/icons/settings-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.security.*') ? asset('img/icons/settings-h.svg') : asset('img/icons/settings.svg') }}"
                        alt="security icon">
                    <span>Password & Security</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Mobile sidebar -->
<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-cloak x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>

<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-75 mt-20 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-cloak x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 pt-4 text-gray-800 dark:text-gray-400">
        <a href="#">
            <div class="dark:bg-cool-gray-800 mx-5 bg-gray-900 text-white py-3 px-6 rounded-full">
                <span class="flex justify-center"><img src="{{ asset('img/logo.svg') }}" alt="logo"></span>
            </div>
        </a>

        <ul class="mt-6 px-6">
            <!-- Dashboard -->
            <li class="relative py-2">
                <a href="{{ route('seller.dashboard') }}"
                    class="icon-link {{ request()->routeIs('seller.dashboard') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/dashboard.svg') }}"
                    data-hover="{{ asset('img/icons/dashboard-h.svg') }}"
                    data-active="{{ asset('img/icons/dashboard-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.dashboard') ? asset('img/icons/dashboard-h.svg') : asset('img/icons/dashboard.svg') }}"
                        alt="Dashboard icon" class="icon w-5 h-5">
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Enquiries -->
            <li class="relative py-2">
                <a href="{{ route('seller.enquiries.index') }}"
                    class="icon-link {{ request()->routeIs('seller.enquiries.index') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/enquiries.svg') }}"
                    data-hover="{{ asset('img/icons/enquiries-h.svg') }}"
                    data-active="{{ asset('img/icons/enquiries-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.enquiries.index') ? asset('img/icons/enquiries-h.svg') : asset('img/icons/enquiries.svg') }}"
                        alt="Enquiries icon">
                    <span>Enquires</span>
                </a>
            </li>

            <!-- Modified Requests -->
            <li class="relative py-2">
                <a href="{{ route('seller.modified-orders.index') }}"
                    class="icon-link {{ request()->routeIs('seller.modified-orders.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/timer.svg') }}"
                    data-hover="{{ asset('img/icons/timer-h.svg') }}"
                    data-active="{{ asset('img/icons/timer-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.modified-orders.*') ? asset('img/icons/timer-h.svg') : asset('img/icons/timer.svg') }}"
                        alt="Modified requests icon">
                    <span>Modified Requests</span>
                </a>
            </li>

            <!-- My Orders -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.orders.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/my-orders.svg') }}"
                    data-hover="{{ asset('img/icons/my-orders-h.svg') }}"
                    data-active="{{ asset('img/icons/my-orders-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.orders.*') ? asset('img/icons/my-orders-h.svg') : asset('img/icons/my-orders.svg') }}"
                        alt="Orders icon">
                    <span>My Orders</span>
                </a>
            </li>

            <!-- Customers -->
            <li class="relative py-2">
                <a href="{{ route('seller.customers.index') }}"
                    class="icon-link {{ request()->routeIs('seller.customers.index') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/customers.svg') }}"
                    data-hover="{{ asset('img/icons/customer-h.svg') }}"
                    data-active="{{ asset('img/icons/customer-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.customers.index') ? asset('img/icons/customer-h.svg') : asset('img/icons/customers.svg') }}"
                        alt="customers icon">
                    <span>Customers</span>
                </a>
            </li>

            <!-- Documents -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.documents.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/documents.svg') }}"
                    data-hover="{{ asset('img/icons/documents-h.svg') }}"
                    data-active="{{ asset('img/icons/documents-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.documents.*') ? asset('img/icons/documents-h.svg') : asset('img/icons/documents.svg') }}"
                        alt="documents icon">
                    <span>Documents</span>
                </a>
            </li>

            <!-- My Products -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.products.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/product.svg') }}"
                    data-hover="{{ asset('img/icons/product-h.svg') }}"
                    data-active="{{ asset('img/icons/product-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.products.*') ? asset('img/icons/product-h.svg') : asset('img/icons/product.svg') }}"
                        alt="product icon">
                    <span>My Products</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="mb-5 px-6 text-gray-800">
        <ul>
            <!-- Help Center -->
            <li class="relative py-2">
                <a href="#"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-200 hover:text-orange-500 dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md">
                    <span class="flex gap-3">
                        <img src="{{ asset('img/icons/help.svg') }}" alt="help icon">
                        Help Center
                    </span>
                    <span
                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full dark:text-red-100 dark:bg-red-600">
                        8
                    </span>
                </a>
            </li>

            <!-- Settings -->
            <li class="relative py-2">
                <a href="#"
                    class="icon-link {{ request()->routeIs('seller.security.*') ? 'active bg-orange-500 text-white' : '' }} inline-flex gap-3 items-center w-full text-sm font-semibold transition-colors duration-200 hover:bg-orange-500 hover:text-white dark:hover:text-gray-200 dark:text-gray-100 p-2 rounded-md"
                    data-default="{{ asset('img/icons/settings.svg') }}"
                    data-hover="{{ asset('img/icons/settings-h.svg') }}"
                    data-active="{{ asset('img/icons/settings-h.svg') }}">
                    <img src="{{ request()->routeIs('seller.security.*') ? asset('img/icons/settings-h.svg') : asset('img/icons/settings.svg') }}"
                        alt="security icon">
                    <span>Password & Security</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<script>
    // Optional: Add hover effects for non-active menu items
    document.addEventListener('DOMContentLoaded', function() {
        const menuLinks = document.querySelectorAll('.icon-link');

        menuLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    const icon = this.querySelector('img');
                    const hoverIcon = this.getAttribute('data-hover');
                    if (icon && hoverIcon) {
                        icon.src = hoverIcon;
                    }
                }
            });

            link.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    const icon = this.querySelector('img');
                    const defaultIcon = this.getAttribute('data-default');
                    if (icon && defaultIcon) {
                        icon.src = defaultIcon;
                    }
                }
            });
        });
    });
</script>
