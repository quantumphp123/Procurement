<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="backdrop-filter: blur(5px);">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-xl text-center mx-4">
        <img src="{{ asset('assets/img/icons/Illustration.svg') }}"
             alt="Success icon with confetti"
             class="w-44 h-44 mb-6 mx-auto drop-shadow-lg">

        <h1 class="text-2xl font-semibold text-black mb-2" style="font-family: 'Poppins', sans-serif;">
            {{ $title ?? 'Congratulations!' }}
        </h1>

        <p class="text-sm text-gray-500 px-4 mb-8">
            {{ $message ?? 'Your account has been created successfully!' }}
        </p>

        <button onclick="{{ $onClickAction ?? 'closeModal()' }}"
                class="w-full py-3 text-sm font-semibold text-white bg-[#f87171] rounded-full hover:bg-[#f87171cc] transition-colors">
            {{ $buttonText ?? 'Continue' }}
        </button>
    </div>
</div>

<script>
    function showSuccessModal() {
        document.getElementById('successModal').classList.remove('hidden');
        document.getElementById('successModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('successModal').classList.add('hidden');
        document.getElementById('successModal').classList.remove('flex');
    }

    function goToDashboard() {
        window.location.href = '{{ route("seller.dashboard") }}';
    }

    // Auto show modal if session has success message
    @if(session('registration_success') || session('show_success_modal'))
        document.addEventListener('DOMContentLoaded', function() {
            showSuccessModal();
        });
    @endif
</script>
