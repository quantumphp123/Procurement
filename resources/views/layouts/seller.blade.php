<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Procurement Dashboard')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}">

    @stack('styles')
</head>

<body x-data="data()">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Sidebar -->
        @include('sidebar.seller-sidebar')

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            @include('header.seller-header')
            <!-- Main Content -->
            <main class="h-full overflow-y-auto">
                <div class="container-fluid px-6 mx-auto grid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Modals -->
    @stack('modals')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/init-alpine.js') }}" defer></script>
    <script src="{{ asset('js/focus-trap.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    @stack('scripts')
</body>

</html>
