{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ProTrade - Procurement Platform')</title>

    {{-- CSS Assets --}}
    <link href="{{ asset('frontend/css/output.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/input.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    {{-- Additional head content --}}
    @stack('head')

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 20s linear infinite;
        }

        .bg-gradient {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }

        .bg-gradient-reverse {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .color {
            background-color: #FF7A59;
        }

        .footer-color {
            background-color: #f9fafb;
        }
    </style>
</head>

<body>
    {{-- Header Component --}}
    @include('customer.layouts.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer Component --}}
    @include('customer.layouts.footer')

    {{-- Modals --}}
    @include('customer.auth.signin-modal')

    {{-- JavaScript Assets --}}
    <script src="{{ asset('frontend/js/index.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    {{-- Additional scripts --}}
    @stack('scripts')

    {{-- Custom Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Toastr configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": true,
            "progressBar": true,
            "rtl": false
        };

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif

        @if (Session::has('toast'))
            toastr.{{ Session::get('toast.type', 'warning') }}("{{ Session::get('toast.message') }}");
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginToggleBtn = document.getElementById('login-toggle-btn');
            const loginBox = document.getElementById('login-box');
            const dropdownLoginBtn = document.getElementById('dropdown-login-btn');
            const signinModal = document.getElementById('signin-modal');

            // 1. Toggle dropdown on Login/Register button click
            if (loginToggleBtn && loginBox) {
                loginToggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    loginBox.classList.toggle('hidden');
                });
            }

            // 2. Open modal on Login button in dropdown
            if (dropdownLoginBtn && signinModal) {
                dropdownLoginBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    signinModal.classList.remove('hidden');
                    signinModal.classList.add('flex');
                    loginBox.classList.add('hidden');
                });
            }

            // 3. Close dropdown if clicking outside
            document.addEventListener('click', function(e) {
                if (loginBox && !loginBox.contains(e.target) && !loginToggleBtn.contains(e.target)) {
                    loginBox.classList.add('hidden');
                }
            });

            // 4. Close modal when clicking outside modal content
            if (signinModal) {
                signinModal.addEventListener('click', function(e) {
                    if (e.target === signinModal) {
                        signinModal.classList.add('hidden');
                        signinModal.classList.remove('flex');
                    }
                });
            }
        });

        function showTab(tab) {
            const tabs = ['all', 'shortlisted', 'modified'];

            tabs.forEach(name => {
                const tabContent = document.getElementById(`${name}Tab`);
                const tabBtn = document.getElementById(`${name}Btn`);

                if (name === tab) {
                    tabContent.classList.remove('hidden');
                    tabBtn.classList.add('text-[#3b5de7]', 'border-b-2', 'border-[#3b5de7]', 'font-semibold');
                    tabBtn.classList.remove('text-[#1f2937]');
                } else {
                    tabContent.classList.add('hidden');
                    tabBtn.classList.remove('text-[#3b5de7]', 'border-b-2', 'border-[#3b5de7]', 'font-semibold');
                    tabBtn.classList.add('text-[#1f2937]');
                }
            });
        }
    </script>

    <script>
        const inputs = document.querySelectorAll(".otp-input");

        inputs.forEach((input) => {
            input.classList.add("w-12", "h-14", "border-2", "rounded-lg", "text-center", "text-2xl",
                "font-semibold", "outline-none", "transition-colors");

            input.addEventListener("focus", () => {
                input.classList.remove("border-gray-300", "border-black");
                input.classList.add("border-orange-400");
            });

            input.addEventListener("blur", () => {
                if (input.value) {
                    input.classList.remove("border-orange-400");
                    input.classList.add("border-black");
                } else {
                    input.classList.remove("border-orange-400", "border-black");
                    input.classList.add("border-gray-300");
                }
            });

            input.addEventListener("input", () => {
                if (input.value) {
                    input.classList.remove("border-orange-400", "border-gray-300");
                    input.classList.add("border-black");
                    // Auto focus next input
                    const next = input.nextElementSibling;
                    if (next && next.tagName === "INPUT") next.focus();
                }
            });
        });
    </script>

    @yield('modals')
</body>

</html>
