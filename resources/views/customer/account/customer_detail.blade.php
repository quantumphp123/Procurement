@extends('customer.layouts.app')

@section('content')
<section class="relative bg-center bg-cover h-80" style="background-image: url('assets/images/banner.jpg');">
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
  <section class="max-w-6xl p-4 mx-auto">
    <h1 class="mt-3 mb-3 text-3xl">Company Details</h1>

    <!-- Profile Picture Upload -->
    <div class="mt-6 mb-6">
      <label class="block mb-2 text-xl font-medium text-black">Profile Picture</label>
      <label class="block mb-2 text-sm font-medium text-gray-300">Choose your best picture that represent you</label>
      <div class="flex items-center space-x-4">
        <img src="assets/images/user1.jpg" alt="Profile" class="object-cover border border-gray-300 rounded-full w-22 h-22">
        <div class="flex-1 p-4 text-center text-gray-400 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer">
          <img src="assets/images/Cloud Upload.svg" alt="Upload" class="w-5 h-5 mx-auto mb-2">
          <input type="file" accept="image/*" class="hidden" id="upload-profile">
          <label for="upload-profile" class="text-sm text-orange-500 cursor-pointer hover:underline">Click to upload</label>
          <span class="block text-xs">or drag and drop<br>SVG, PNG, JPG, or GIF (max 800x400px)</span>
        </div>
      </div>
    </div>

    <!-- Company Details Form -->
    <form class="w-full max-w-4xl space-y-6">
      <div class="flex items-center">
        <label for="company" class="px-4 text-lg text-black w-46">Company Name</label>
        <input id="company" type="text" value="LDL Pvt Ltd" class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
      </div>

      <div class="flex items-center">
        <label for="contact" class="px-4 text-lg text-black w-46">Contact Number</label>
        <input id="contact" type="text" value="+91 8723693943" class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
      </div>

      <div class="flex items-center">
        <label for="email" class="px-4 text-lg text-black w-46">Enter email ID</label>
        <input id="email" type="email" value="jackie23@gmail.com" class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
      </div>

      <div class="flex items-start">
        <label for="address" class="px-4 pt-3 text-lg text-black w-46">Add delivery address</label>
        <textarea id="address" rows="3" class="flex-1 p-3 text-base text-black border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">Genevia, Near Rock garden, London UK, 432232 WJU, UIK</textarea>
      </div>
    </form>

    <!-- Buttons -->
    <div class="flex items-center justify-center gap-4 mt-8 mb-8">
      <button class="pt-4 pb-4 text-black border border-2 border-gray-400 rounded-full ps-14 pe-14">Discard</button>
      <button class="pt-4 pb-4 text-white rounded-full ps-14 pe-14 color hover:bg-orange-600">Save Details</button>
    </div>
  </section>

@endsection