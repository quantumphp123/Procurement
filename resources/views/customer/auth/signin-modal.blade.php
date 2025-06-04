<div id="signin-modal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50">
    <div class="relative max-w-md p-6 mx-auto bg-white shadow-md rounded-2xl ">
        <!-- Close Button -->
        <button onclick="document.getElementById('signin-modal').classList.add('hidden')"
            class="absolute flex items-center justify-center w-8 h-8 text-orange-500 bg-red-100 rounded-full top-4 right-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Header -->
        <h2 class="mb-1 text-2xl font-semibold text-gray-900">Sign In</h2>
        <p class="mb-6 text-sm text-gray-600">Don't have an existing account? <a href="{{ route('customer.register') }}"
                class="font-medium text-orange-500 underline">Sign Up</a></p>

        @if (session('error'))
            <div id="login-error-message"
                class="px-3 py-2 mb-4 font-semibold text-center bg-red-100 border border-red-400 rounded"
                style="color: #b91c1c;">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            <!-- Email Input -->
            <label class="block mb-1 text-sm font-medium text-gray-800">
                Email <span class="text-red-500">*</span>
            </label>
            <div class="relative mb-4">
                <input type="email" name="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-1 focus:ring-orange-400 @error('email') border-red-500 @enderror" />
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-3.5 w-5 h-5 text-green-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Password Input -->
            <label class="block mb-1 text-sm font-medium text-gray-800">
                Password <span class="text-red-500">*</span>
            </label>
            <div class="relative mb-1">
                <input type="password" name="password" id="password-input"
                    class="w-full border-2 border-blue-600 rounded-lg px-4 py-2 pr-10 focus:outline-none @error('password') border-red-500 @enderror" />
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute right-3 top-3.5 w-5 h-5 text-gray-500 cursor-pointer"
                    id="toggle-password"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    onclick="togglePasswordVisibility()">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div class="mb-6 text-sm text-right">
                <a href="#" class="text-orange-500 hover:underline" onclick="openForgotPasswordModal()">Forgot
                    password?</a>
            </div>

            <!-- Sign In Button -->
            <button type="submit"
                class="w-full py-3 mb-4 text-lg font-medium text-white rounded-full color hover:bg-orange-500">
                Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center justify-center mb-4 text-sm text-gray-400">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="px-3">or</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <!-- OTP Login -->
        <div class="mb-6 text-sm text-center">
            <a href="#" class="font-medium text-orange-500 underline">Login With OTP</a>
        </div>

        <!-- reCAPTCHA Notice -->
        <p class="text-[11px] text-center text-gray-500">
            Protected by reCAPTCHA and subject to the
            <a href="#" class="text-orange-500 underline">ProTrade's Privacy Policy</a> and
            <a href="#" class="text-orange-500 underline">Terms of Service</a>.
        </p>
    </div>
</div>

<!-- Forgot Password Modal -->
<div id="forgot-password-modal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50">
    <div class="relative max-w-md p-6 mx-auto bg-white shadow-md rounded-2xl">
        <!-- Close Button -->
        <button onclick="closeForgotPasswordModal()"
            class="absolute flex items-center justify-center w-8 h-8 text-orange-500 bg-red-100 rounded-full top-4 right-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="mb-1 text-2xl font-semibold text-gray-900">Forgot Password</h2>
        <p class="mb-6 text-sm text-gray-600">Enter your email to receive a password reset link.</p>
        @if ($errors->any())
            <div class="px-3 py-2 mb-4 font-semibold text-center text-red-700 bg-red-100 border border-red-400 rounded">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label class="block mb-1 text-sm font-medium text-gray-800">Email <span
                    class="text-red-500">*</span></label>
            <input type="email" name="email" required
                class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-orange-400" />
            <button type="submit"
                class="w-full py-3 mb-4 text-lg font-medium text-white rounded-full color hover:bg-orange-500">Send
                Reset Link</button>
        </form>
        <div class="text-center">
            <button onclick="closeForgotPasswordModal(); openSigninModal();"
                class="text-sm text-orange-500 underline">Back to Sign In</button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                // Show the modal if there's a login error
                var modal = document.getElementById('signin-modal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            @endif
        });

        function openForgotPasswordModal() {
            document.getElementById('signin-modal').classList.add('hidden');
            var modal = document.getElementById('forgot-password-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeForgotPasswordModal() {
            var modal = document.getElementById('forgot-password-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function openSigninModal() {
            var modal = document.getElementById('signin-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password-input');
            const toggleIcon = document.getElementById('toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerHTML = `
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
@endpush

@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success('Password reset link sent to your email. Please check and update your password.');
        });
    </script>
@endif
