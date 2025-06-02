<div id="signin-modal" class="fixed inset-0 bg-black/50  items-center justify-center z-50 hidden">
    <div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow-md relative ">
        <!-- Close Button -->
        <button onclick="document.getElementById('signin-modal').classList.add('hidden')"
            class="absolute top-4 right-4 w-8 h-8 rounded-full bg-red-100 text-orange-500 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Header -->
        <h2 class="text-2xl font-semibold text-gray-900 mb-1">Sign In</h2>
        <p class="text-sm text-gray-600 mb-6">Don't have an existing account? <a href="{{ route('customer.register') }}"
                class="text-orange-500 font-medium underline">Sign Up</a></p>

        @if (session('error'))
            <div id="login-error-message"
                class="mb-4 text-center bg-red-100 border border-red-400 rounded px-3 py-2 font-semibold"
                style="color: #b91c1c;">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            <!-- Email Input -->
            <label class="block text-sm font-medium mb-1 text-gray-800">
                Email <span class="text-red-500">*</span>
            </label>
            <div class="relative mb-4">
                <input type="email" name="email" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-1 focus:ring-orange-400 @error('email') border-red-500 @enderror" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-3.5 w-5 h-5 text-green-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Password Input -->
            <label class="block text-sm font-medium mb-1 text-gray-800">
                Password <span class="text-red-500">*</span>
            </label>
            <div class="relative mb-1">
                <input type="password" name="password" required
                    class="w-full border-2 border-blue-600 rounded-lg px-4 py-2 pr-10 focus:outline-none @error('password') border-red-500 @enderror" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute right-3 top-3.5 w-5 h-5 text-gray-500 cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div class="text-right text-sm mb-6">
                <a href="#" class="text-orange-500 hover:underline" onclick="openForgotPasswordModal()">Forgot
                    password?</a>
            </div>

            <!-- Sign In Button -->
            <button type="submit"
                class="w-full color hover:bg-orange-500 text-white font-medium py-3 rounded-full text-lg mb-4">
                Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center justify-center text-gray-400 text-sm mb-4">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="px-3">or</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <!-- OTP Login -->
        <div class="text-center text-sm mb-6">
            <a href="#" class="text-orange-500 font-medium underline">Login With OTP</a>
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
<div id="forgot-password-modal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
    <div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow-md relative">
        <!-- Close Button -->
        <button onclick="closeForgotPasswordModal()"
            class="absolute top-4 right-4 w-8 h-8 rounded-full bg-red-100 text-orange-500 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="text-2xl font-semibold text-gray-900 mb-1">Forgot Password</h2>
        <p class="text-sm text-gray-600 mb-6">Enter your email to receive a password reset link.</p>
        @if ($errors->any())
            <div class="mb-4 text-center bg-red-100 border border-red-400 rounded px-3 py-2 font-semibold text-red-700">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label class="block text-sm font-medium mb-1 text-gray-800">Email <span
                    class="text-red-500">*</span></label>
            <input type="email" name="email" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-1 focus:ring-orange-400" />
            <button type="submit"
                class="w-full color hover:bg-orange-500 text-white font-medium py-3 rounded-full text-lg mb-4">Send
                Reset Link</button>
        </form>
        <div class="text-center">
            <button onclick="closeForgotPasswordModal(); openSigninModal();"
                class="text-orange-500 underline text-sm">Back to Sign In</button>
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
    </script>
@endpush

@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success('Password reset link sent to your email. Please check and update your password.');
        });
    </script>
@endif
