<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Procurement Dashboard')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    @stack('styles')
</head>

<body x-data="data()">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Sidebar only for authenticated users -->
        @auth
            @if (auth()->user()->hasVerifiedEmail() &&
                    !in_array(Route::currentRouteName(), [
                        'seller.register',
                        'seller.register.step2.form',
                        'seller.register.step3.form',
                        'seller.register.plans',
                        'seller.login',
                        'password.request',
                        'password.email',
                        'password.reset',
                        'password.update',
                    ]))
                @include('seller.sidebar.seller-sidebar')
            @endif
        @endauth

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            @include('seller.header.seller-header', [
                'pageTitle' => $pageTitle ?? null,
                'breadcrumbTitle' => $breadcrumbTitle ?? null,
                'breadcrumbRoute' => $breadcrumbRoute ?? null,
                'breadcrumbCurrent' => $breadcrumbCurrent ?? null,
            ])

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
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="{{ asset('js/focus-trap.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr Global Settings -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };

        // Display flash messages as toasts
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif

        @if (session('warning'))
            toastr.warning('{{ session('warning') }}');
        @endif

        @if (session('info'))
            toastr.info('{{ session('info') }}');
        @endif

        {{--  // Display validation errors as toasts
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif  --}}
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('scripts')
</body>

</html>
