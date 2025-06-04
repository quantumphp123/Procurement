<div id="reset-password-modal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 flex">
    <div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow-md relative">
        <h2 class="text-2xl font-semibold text-gray-900 mb-1">Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <label class="block text-sm font-medium mb-1 text-gray-800">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-1 focus:ring-orange-400" />
            <label class="block text-sm font-medium mb-1 text-gray-800">New Password <span
                    class="text-red-500">*</span></label>
            <input type="password" name="password" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-1 focus:ring-orange-400" />
            <label class="block text-sm font-medium mb-1 text-gray-800">Confirm Password <span
                    class="text-red-500">*</span></label>
            <input type="password" name="password_confirmation" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-1 focus:ring-orange-400" />
            <button type="submit"
                class="w-full color hover:bg-orange-500 text-white font-medium py-3 rounded-full text-lg">Reset
                Password</button>
        </form>
    </div>
</div>
