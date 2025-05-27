     <header class="z-10 py-4 bg-white border-b dark:border-gray-700 dark:bg-gray-800">
         <div
             class="container-fluid mx-4 flex items-center justify-between h-full px-4 text-orange-600 dark:text-orange-300">
             <!-- Mobile hamburger -->
             <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-orange"
                 @click="toggleSideMenu" aria-label="Menu">
                 <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                     <path fill-rule="evenodd"
                         d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                         clip-rule="evenodd"></path>
                 </svg>
             </button>
             <!-- Search input -->
             <div class="flex justify-start flex-1">
                 <div class="relative w-full max-w-sm mr-6 focus-within:text-orange-500">
                     <!-- Mobile-only icon -->
                     <div class="absolute inset-y-0 flex items-center pl-2 sm:hidden">
                         <img src="{{ asset('img/icons/search-icon.svg') }}" alt="">
                     </div>

                     <input
                         class="w-full py-3 pl-10 pr-2 text-md text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-gray-800 border-0 bg-gray-100 rounded-lg
      dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:placeholder-gray-400 dark:focus:border-blue-500 focus:placeholder-gray-500 focus:bg-white form-input"
                         type="text" placeholder="Search for orders/enquiries/customers" aria-label="Search" />
                 </div>

             </div>
             <ul class="flex items-center flex-shrink-0 space-x-6">
                 <li class="relative">
                     <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-orange"
                         @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                         aria-label="Notifications" aria-haspopup="true">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none">
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M4.99996 5.75C4.3096 5.75 3.74996 6.30964 3.74996 7V17C3.74996 17.6904 4.3096 18.25 4.99996 18.25H19C19.6903 18.25 20.25 17.6904 20.25 17V7C20.25 6.30964 19.6903 5.75 19 5.75H4.99996ZM2.24996 7C2.24996 5.48122 3.48117 4.25 4.99996 4.25H19C20.5187 4.25 21.75 5.48122 21.75 7V17C21.75 18.5188 20.5187 19.75 19 19.75H4.99996C3.48117 19.75 2.24996 18.5188 2.24996 17V7Z"
                                 fill="#111827" />
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M2.37592 6.58397C2.60568 6.23933 3.07134 6.1462 3.41598 6.37596L12 12.0986L20.5839 6.37596C20.9286 6.1462 21.3942 6.23933 21.624 6.58397C21.8538 6.92862 21.7606 7.39427 21.416 7.62404L12.416 13.624C12.1641 13.792 11.8359 13.792 11.5839 13.624L2.58393 7.62404C2.23929 7.39427 2.14616 6.92862 2.37592 6.58397Z"
                                 fill="#111827" />
                         </svg>
                         <!-- Notification badge -->
                         <span aria-hidden="true"
                             class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                     </button>
                     <template x-if="isNotificationsMenuOpen">
                         <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0" @click.away="closeNotificationsMenu"
                             @keydown.escape="closeNotificationsMenu"
                             class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                             <!-- <li class="flex">
                    <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                      href="#">
                      <span>Messages</span>
                      <span
                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                        13
                      </span>
                    </a>
                  </li> -->
                             <li class="flex">
                                 <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 text-black rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                     href="#">
                                     <span>Sales</span>
                                     <span
                                         class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full dark:text-red-100 dark:bg-red-600">
                                         2
                                     </span>
                                 </a>
                             </li>
                             <li class="flex">
                                 <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold text-black transition-colors duration-150 hover:bg-gray-100 rounded-md dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                     href="#">
                                     <span>Alerts</span>
                                 </a>
                             </li>

                         </ul>
                     </template>
                 </li>

                 <!-- Profile menu -->
                 <li class="relative">
                     <button class="flex items-center gap-2 rounded-full focus:shadow-outline-orange focus:outline-none"
                         @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                         aria-haspopup="true">
                         <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('img/users/user1.jpg') }}"
                             alt="" aria-hidden="true" />
                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                             fill="none">
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M3.08748 4.83736C3.31529 4.60955 3.68463 4.60955 3.91244 4.83736L6.99996 7.92488L10.0875 4.83736C10.3153 4.60955 10.6846 4.60955 10.9124 4.83736C11.1402 5.06516 11.1402 5.43451 10.9124 5.66232L7.41244 9.16232C7.18463 9.39012 6.81529 9.39012 6.58748 9.16232L3.08748 5.66232C2.85967 5.43451 2.85967 5.06516 3.08748 4.83736Z"
                                 fill="#111827" />
                         </svg>
                     </button>
                     <template x-if="isProfileMenuOpen">
                         <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0" @click.away="closeProfileMenu"
                             @keydown.escape="closeProfileMenu"
                             class="absolute right-0 w-64 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                             aria-label="submenu">
                             <li class="flex">
                                 <a class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                     href="#">
                                     <span class="flex gap-3 text-black"><img
                                             src="{{ asset('img/icons/user-icon.svg') }}" alt="User Icon" height="18"
                                             width="18">
                                         Profile</span>
                                     <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                             viewBox="0 0 24 25" fill="none">
                                             <path
                                                 d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                                                 fill="black" />
                                         </svg></span>
                                 </a>
                             </li>
                             <li class="flex">
                                 <a class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                     href="#">
                                     <span class="flex gap-3 text-black"><img
                                             src="{{ asset('img/icons/star-icon.svg') }}" alt="Subscription"
                                             height="18" width="18">
                                         My Subscription Plan</span>
                                     <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                             viewBox="0 0 24 25" fill="none">
                                             <path
                                                 d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                                                 fill="black" />
                                         </svg>
                                     </span>
                                 </a>
                             </li>
                             <li class="flex">
                                 <a class="inline-flex justify-between items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                     href="#">
                                     <span class="flex gap-3 text-red-600"><img
                                             src="{{ asset('img/icons/log-out.svg') }}" alt="logout" height="18"
                                             width="18">
                                         Logout</span>
                                     <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                             viewBox="0 0 24 25" fill="none">
                                             <path
                                                 d="M16.004 9.914L7.39703 18.521L5.98303 17.107L14.589 8.5H7.00403V6.5H18.004V17.5H16.004V9.914Z"
                                                 fill="#DF1C41" />
                                         </svg>
                                     </span>
                                 </a>
                             </li>
                         </ul>
                     </template>
                 </li>
             </ul>
         </div>
     </header>
