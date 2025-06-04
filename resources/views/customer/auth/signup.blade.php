@extends('customer.layouts.app')

@section('content')
    <section class="relative bg-cover bg-center"
        style="background-image: url('{{ asset('frontend/assets/images/banner.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative max-w-6xl mx-auto px-1 py-30 text-white">
            <h2 class="text-3xl md:text-5xl font-bold mb-4 mt-10">
                Register with us to get started with us!
            </h2>
            <p class="text-lg md:text-xl text-gray-200">
                Browse product categories, post enquiries, and manage your procurement—all in one place.
            </p>
        </div>
    </section>
    <section class="max-w-6xl mx-auto px-4 py-10">
        <h1 class="text-4xl font-bold">Create New Account</h1>
        <br>
        <form class="space-y-10" method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Personal Details -->
            <div>
                <h2 class="text-xl font-semibold mb-6">Personal Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Enter Company Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="JSPM Steel Works" name="company_name"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('company_name') border-red-500 @enderror">
                        @error('company_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Enter Email ID <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="email" placeholder="pristiajain@gmail.com" name="email"
                                class="w-full border rounded-md px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            {{--  <img src="{{ asset('frontend/assets/images/check-icon.png') }}" alt="Check Icon"
                                class="absolute right-3 top-2.5 w-5 h-5">  --}}
                        </div>
                    </div>
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input id="password" type="password" placeholder="Enter your password" name="password"
                                class="w-full border rounded-md px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('password') border-red-500 @enderror">
                            <span onclick="togglePassword('password', 'togglePasswordIcon')"
                                class="absolute right-3 top-2.5 cursor-pointer">
                                <!-- Eye SVG -->
                                <svg id="togglePasswordIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" placeholder="Confirm your password"
                                name="password_confirmation"
                                class="w-full border rounded-md px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('password_confirmation') border-red-500 @enderror">
                            <span onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')"
                                class="absolute right-3 top-2.5 cursor-pointer">
                                <!-- Eye SVG -->
                                <svg id="toggleConfirmPasswordIcon" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Mobile -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Enter Mobile Number <span
                                class="text-red-500">*</span></label>
                        <input type="tel" placeholder="+91 7637484675" name="phone"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Address <span
                                class="text-red-500">*</span></label>
                        <textarea rows="3" placeholder="Company Address" name="address"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Other Details -->
            <div>
                <h2 class="text-xl font-semibold mb-6">Other Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- License -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trade License Number <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="4323 6758 36834" name="license_number"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('license_number') border-red-500 @enderror">
                        @error('license_number')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- VAT -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">VAT</label>
                        <input type="text" placeholder="HHTY 46639 YUI" name="vat_number"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('vat_number') border-red-500 @enderror">
                        @error('vat_number')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Contact Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Person Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="Jane Doe" name="contact_person_name"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('contact_person_name') border-red-500 @enderror">
                        @error('contact_person_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Designation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Person Designation <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="Sales Manager" name="contact_person_designation"
                            class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('contact_person_designation') border-red-500 @enderror">
                        @error('contact_person_designation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Upload VAT -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload VAT document</label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center hover:border-orange-500 transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center text-sm text-gray-500">
                                <input type="file" name="file_path" id="file_input" accept=".pdf,.jpg,.jpeg,.png"
                                    class="hidden @error('file_path') border-red-500 @enderror">
                                <label for="file_input" class="cursor-pointer">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="text-orange-500 font-medium">Click to upload</span> or drag and drop
                                        <span class="text-xs text-gray-400 mt-1">PDF, JPG, JPEG or PNG (max 2MB)</span>
                                    </div>
                                </label>
                                <div id="file_name" class="mt-2 text-sm text-gray-600 hidden"></div>
                                @error('file_path')
                                    <span class="text-red-500 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <div class="flex justify-center">
                <button type="submit"
                    class="color hover:bg-orange-500 text-white font-medium px-10 py-3 rounded-full text-lg">
                    Create Account
                </button>
            </div>
        </form>
    </section>

    <!-- Email Verification Modal -->
    <div id="verification-modal"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 {{ session('show_verification') ? '' : 'hidden' }}">
        <div class="bg-white p-8 rounded-2xl shadow-md relative w-full max-w-md">
            <h2 class="text-2xl font-semibold text-gray-900 mb-2 text-center">Verify Your Email</h2>
            <p class="text-gray-700 text-center mb-4">
                We've sent a verification link to your email address:<br>
                <span class="font-semibold text-black">{{ session('email') }}</span>
            </p>
            <p class="text-center text-gray-500 text-sm mb-6">
                Please check your email and click the verification link to activate your account.
            </p>
            <div class="flex flex-col gap-4">
                <button onclick="showSigninModal()"
                    class="w-full color hover:bg-orange-500 text-white font-medium py-3 rounded-full text-lg">
                    Sign In Now
                </button>
                <button onclick="resendVerification()"
                    class="w-full border border-orange-500 text-orange-500 hover:bg-orange-50 font-medium py-3 rounded-full">
                    Resend Verification Email
                </button>
            </div>
        </div>
    </div>

    @include('customer.auth.signin-modal')

    @push('scripts')
        <script>
            function showSigninModal() {
                document.getElementById('verification-modal').classList.add('hidden');
                document.getElementById('signin-modal').classList.remove('hidden');
                document.getElementById('signin-modal').classList.add('flex');
            }

            function resendVerification() {
                fetch('{{ route('verification.resend') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to resend verification email. Please try again.');
                    });
            }

            // Show signin modal if there's a verification success message
            @if (session('verification_success'))
                showSigninModal();
            @endif

            function togglePassword(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.add('text-orange-500');
                } else {
                    input.type = 'password';
                    icon.classList.remove('text-orange-500');
                }
            }

            // File upload handling
            const fileInput = document.getElementById('file_input');
            const fileName = document.getElementById('file_name');
            const dropZone = fileInput.closest('.border-dashed');

            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Check file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        fileInput.value = '';
                        fileName.classList.add('hidden');
                        return;
                    }

                    // Check file type
                    const validTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please upload a PDF, JPG, JPEG or PNG file');
                        fileInput.value = '';
                        fileName.classList.add('hidden');
                        return;
                    }

                    fileName.textContent = `Selected file: ${file.name}`;
                    fileName.classList.remove('hidden');
                } else {
                    fileName.classList.add('hidden');
                }
            });

            // Drag and drop handling
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('border-orange-500');
            }

            function unhighlight(e) {
                dropZone.classList.remove('border-orange-500');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];
                fileInput.files = dt.files;

                // Trigger change event to handle file validation
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            }
        </script>
    @endpush
@endsection
