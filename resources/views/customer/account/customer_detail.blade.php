@extends('customer.layouts.app')

@section('content')
<!-- Flash Messages -->
@if(session('success'))
<div class="max-w-6xl p-4 mx-auto mt-4">
    <div class="p-4 text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
</div>
@endif

@if(session('error'))
<div class="max-w-6xl p-4 mx-auto mt-4">
    <div class="p-4 text-red-700 bg-red-100 rounded-lg">
        {{ session('error') }}
    </div>
</div>
@endif

@if($errors->any())
<div class="max-w-6xl p-4 mx-auto mt-4">
    <div class="p-4 text-red-700 bg-red-100 rounded-lg">
        <h3 class="mb-2 font-semibold">Please fix the following errors:</h3>
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- Banner Section -->
<section class="relative bg-center bg-cover h-80" style="background-image: url('{{ asset('frontend/assets/images/banner.jpg') }}');">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

  <!-- Content -->
  <div class="absolute flex flex-col items-start justify-center w-full px-4 py-6 space-y-2 -translate-y-1/2 top-64 sm:px-8 md:px-12 sm:py-8 bg-gradient-to-r from-black via-indigo-500 to-transparent">
    <h1 class="text-2xl font-bold text-white sm:text-3xl md:text-4xl">My Account</h1>
    <nav class="flex flex-wrap items-center space-x-1 text-xs text-white sm:text-sm">
      <a href="#" class="hover:underline">Home</a>
      <span class="mx-1">›</span>
      <a href="#" class="hover:underline">Company Details</a>
    </nav>
  </div>
</section>

<!-- Company Details Section -->
<section class="max-w-6xl p-4 px-4 mx-auto sm:px-6 lg:px-8">
  <h1 class="mt-3 mb-3 text-2xl sm:text-3xl">Company Details</h1>



  <!-- Company Details Form -->
  <form id="company-details-form" class="w-full max-w-4xl space-y-6" method="POST" action="{{ route('customer.company.details.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Profile Picture Upload -->
    <div class="mt-6 mb-6">
      <label class="block mb-2 text-lg font-medium text-black sm:text-xl">Profile Picture</label>
      <label class="block mb-2 text-sm font-medium text-gray-300">Choose your best picture that represent you</label>
      <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
          <img id="profile-preview" src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('frontend/assets/images/profile_pic.png') }}"
               alt="Profile" class="object-cover w-20 h-20 border border-gray-300 rounded-full sm:w-22 sm:h-22">
          <div class="relative flex-1 w-full p-4 text-center text-gray-400 border-2 border-gray-300 border-dashed rounded-lg">
              <input type="file" name="profile_pic" id="profile_pic" accept="image/jpeg,image/png,image/jpg" class="hidden" />
              <label for="profile_pic" class="text-sm text-orange-500 cursor-pointer hover:underline">Click to upload</label>
              <span class="block text-xs">JPG, JPEG, or PNG (max 2MB)</span>
          </div>
      </div>
      @error('profile_pic')
          <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0">
      <label for="company" class="w-full px-0 text-base text-black sm:text-lg sm:w-46 sm:px-4">Company Name</label>
      <input
        id="company"
        name="company_name"
        type="text"
        value="{{ old('company_name', $customer->company_name) }}"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('company_name') border-red-500 @enderror"
      />
      @error('company_name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0">
      <label for="contact" class="w-full px-0 text-base text-black sm:text-lg sm:w-46 sm:px-4">Contact Number</label>
      <input
        id="contact"
        name="phone"
        type="text"
        value="{{ old('phone', $user->phone) }}"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('phone') border-red-500 @enderror"
      />
      @error('phone')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0">
      <label for="email" class="w-full px-0 text-base text-black sm:text-lg sm:w-46 sm:px-4">Email ID</label>
      <input
        id="email"
        name="email"
        type="email"
        value="{{ old('email', $user->email) }}"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror"
      />
      @error('email')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-start sm:space-y-0">
      <label for="address" class="w-full px-0 pt-0 text-base text-black sm:text-lg sm:w-46 sm:pt-3 sm:px-4">Delivery Address</label>
      <textarea
        id="address"
        name="address"
        rows="3"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('address') border-red-500 @enderror"
      >{{ old('address', $user->address) }}</textarea>
      @error('address')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0">
      <label for="license" class="w-full px-0 text-base text-black sm:text-lg sm:w-46 sm:px-4">License Number</label>
      <input
        id="license"
        name="license_number"
        type="text"
        value="{{ old('license_number', $customer->license_number) }}"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('license_number') border-red-500 @enderror"
        readonly
      />
      @error('license_number')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0">
      <label for="contact_person" class="w-full px-0 text-base text-black sm:text-lg sm:w-46 sm:px-4">Contact Person</label>
      <input
        id="contact_person"
        name="contact_person_name"
        type="text"
        value="{{ old('contact_person_name', $customer->contact_person_name) }}"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('contact_person_name') border-red-500 @enderror"
      />
      @error('contact_person_name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0">
      <label for="designation" class="w-full px-0 text-base text-black sm:text-lg sm:w-46 sm:px-4">Designation</label>
      <input
        id="designation"
        name="contact_person_designation"
        type="text"
        value="{{ old('contact_person_designation', $customer->contact_person_designation) }}"
        class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('contact_person_designation') border-red-500 @enderror"
      />
      @error('contact_person_designation')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <!-- Buttons - Moved inside the form -->
    <div class="flex flex-col items-center justify-center gap-4 mt-8 mb-8 sm:flex-row">
      <button type="button" onclick="window.location.reload()" class="w-full px-8 pt-4 pb-4 text-black border border-2 border-gray-400 rounded-full sm:w-auto sm:px-14">Discard</button>
      <button type="submit" class="w-full px-8 pt-4 pb-4 text-white bg-orange-500 rounded-full sm:w-auto sm:px-14 hover:bg-orange-600">Save Details</button>
    </div>
  </form>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('company-details-form');
    const profileInput = document.getElementById('profile_pic');
    const profilePreview = document.getElementById('profile-preview');

    // Debug function
    function logFormData(formData) {
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + (pair[1] instanceof File ? pair[1].name : pair[1]));
        }
    }

    // Simple preview functionality
    profileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            console.log('File selected:', {
                name: file.name,
                type: file.type,
                size: file.size
            });

            const reader = new FileReader();
            reader.onload = function(e) {
                profilePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        // Debug: Log form data
        console.log('Form data before submission:');
        logFormData(formData);

        // Submit the form
        form.submit();
    });
});
</script>
@endpush

@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
