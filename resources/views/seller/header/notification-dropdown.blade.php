<button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-orange"
        @click="toggleNotificationsMenu"
        @keydown.escape="closeNotificationsMenu"
        aria-label="Notifications"
        aria-haspopup="true">

    <!-- Mail/Notification Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M4.99996 5.75C4.3096 5.75 3.74996 6.30964 3.74996 7V17C3.74996 17.6904 4.3096 18.25 4.99996 18.25H19C19.6903 18.25 20.25 17.6904 20.25 17V7C20.25 6.30964 19.6903 5.75 19 5.75H4.99996ZM2.24996 7C2.24996 5.48122 3.48117 4.25 4.99996 4.25H19C20.5187 4.25 21.75 5.48122 21.75 7V17C21.75 18.5188 20.5187 19.75 19 19.75H4.99996C3.48117 19.75 2.24996 18.5188 2.24996 17V7Z"
              fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M2.37592 6.58397C2.60568 6.23933 3.07134 6.1462 3.41598 6.37596L12 12.0986L20.5839 6.37596C20.9286 6.1462 21.3942 6.23933 21.624 6.58397C21.8538 6.92862 21.7606 7.39427 21.416 7.62404L12.416 13.624C12.1641 13.792 11.8359 13.792 11.5839 13.624L2.58393 7.62404C2.23929 7.39427 2.14616 6.92862 2.37592 6.58397Z"
              fill="currentColor" />
    </svg>

    <!-- Notification badge -->
    <span aria-hidden="true"
          class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800">
    </span>
</button>

<!-- Dropdown Menu -->
<template x-if="notificationsMenuOpen">
    <ul x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.away="closeNotificationsMenu"
        @keydown.escape="closeNotificationsMenu"
        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">

        <!-- Sales Notification -->
        <li class="flex">
            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 text-black rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200"
               href="#">
                <span>Sales</span>
                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full dark:text-red-100 dark:bg-red-600">
                    {{ $salesNotificationCount ?? 2 }}
                </span>
            </a>
        </li>

        <!-- Alerts -->
        <li class="flex">
            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold text-black transition-colors duration-150 hover:bg-gray-100 rounded-md dark:hover:bg-gray-800 dark:hover:text-gray-200"
               href="#">
                <span>Alerts</span>
            </a>
        </li>

        <!-- View All Notifications -->
        <li class="flex border-t pt-2">
            <a class="inline-flex items-center justify-center w-full px-2 py-1 text-sm font-semibold text-orange-600 transition-colors duration-150 hover:bg-gray-100 rounded-md dark:hover:bg-gray-800"
               href="#">
                View All Notifications
            </a>
        </li>

    </ul>
</template>
