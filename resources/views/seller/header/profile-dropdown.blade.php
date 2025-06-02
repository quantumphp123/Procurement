<button class="flex items-center gap-2 rounded-full focus:shadow-outline-orange focus:outline-none"
        @click="toggleProfileMenu"
        @keydown.escape="closeProfileMenu"
        aria-label="Account"
        aria-haspopup="true">

    <!-- User Avatar -->
    <img class="object-cover w-8 h-8 rounded-full"
         src="{{ auth()->user()->avatar ?? asset('assets/img/users/default-user.jpg') }}"
         alt="{{ auth()->user()->name ?? 'User' }}"
         aria-hidden="true" />

    <!-- Dropdown Arrow -->
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M3.08748 4.83736C3.31529 4.60955 3.68463 4.60955 3.91244 4.83736L6.99996 7.92488L10.0875 4.83736C10.3153 4.60955 10.6846 4.60955 10.9124 4.83736C11.1402 5.06516 11.1402 5.43451 10.9124 5.66232L7.41244 9.16232C7.18463 9.39012 6.81529 9.39012 6.58748 9.16232L3.08748 5.66232C2.85967 5.43451 2.85967 5.06516 3.08748 4.83736Z"
              fill="currentColor" />
    </svg>
</button>

<!-- Profile Dropdown Menu -->
<template x-if="profileMenuOpen">
    <ul x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.away="closeProfileMenu"
        @keydown.escape="closeProfileMenu"
        class="absolute right-0 w-64 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
        aria-label="submenu">

        <!-- User Info -->
        <li class="px-2 py-2 border-b dark:border-gray-600">
            <div class="flex items-center space-x-3">
                <img class="object-cover w-10 h-10 rounded-full"
                     src="{{ auth()->user()->avatar ?? asset('assets/img/users/default-user.jpg') }}"
                     alt="{{ auth()->user()->name ?? 'User' }}">
                <div>
                    <p class="text-sm font-semibold dark:text-white">{{ auth()->user()->name ?? 'User Name' }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                </div>
            </div>
        </li>

        <!-- Profile Link -->
        <li class="flex">
            <a class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
               href="{{ route('seller.profile') }}">
                <span class="flex gap-3 text-black dark:text-white">
                    <!-- User Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    Profile
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                              fill="currentColor" />
                    </svg>
                </span>
            </a>
        </li>

        <!-- Subscription Link -->
        <li class="flex">
            <a class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
               href="{{ route('seller.subscription') }}">
                <span class="flex gap-3 text-black dark:text-white">
                    <!-- Star Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    My Subscription Plan
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                              fill="currentColor" />
                    </svg>
                </span>
            </a>
        </li>

        <!-- Settings -->
        <li class="flex">
            <a class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
               href="{{ route('seller.settings') }}">
                <span class="flex gap-3 text-black dark:text-white">
                    <!-- Settings Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                    </svg>
                    Settings
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                              fill="currentColor" />
                    </svg>
                </span>
            </a>
        </li>

        <!-- Logout -->
        <li class="flex border-t pt-2">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                        class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20">
                    <span class="flex gap-3 text-red-600">
                        <!-- Logout Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 01-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                        Logout
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                                  fill="#DF1C41" />
                        </svg>
                    </span>
                </button>
            </form>
        </li>

    </ul>
</template>
