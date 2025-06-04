@extends('customer.layouts.app')

@section('content')
    <section class="relative bg-cover bg-center h-80" style="background-image: url('{{ asset('frontend/assets/images/banner.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

        <!-- Content -->
        <div
            class="absolute top-64 -translate-y-1/2 w-full px-4 sm:px-8 md:px-12 py-6 sm:py-8 flex flex-col items-start justify-center bg-gradient-to-r from-black via-indigo-500 to-transparent space-y-2">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                Enquiry Management
            </h1>
            <nav class="text-xs sm:text-sm text-white flex flex-wrap items-center space-x-1">
                <a href="#" class="hover:underline">Home</a>
                <span class="mx-1">›</span>
                <a href="#" class="hover:underline">Enquiry Management</a>
                <span class="mx-1">›</span>
                <span class="font-semibold">My Enquiries</span>
            </nav>
        </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-md w-7xl mx-auto mt-7 mb-7">
        <!-- Title -->
        <h2 class="text-center text-3xl font-semibold mb-2">{{ $isEditMode ? 'Edit Enquiry' : 'Enquiry Table' }}</h2>
        <p class="text-left text-black text-xl mb-6">{{ $isEditMode ? 'Edit your enquiry details below' : 'Submit required details in below table' }}</p>

        <!-- Display General Form Errors -->
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Display Session Messages -->
        @if(session('message'))
            <div class="mb-6 p-4 rounded-lg {{ session('alert-type') === 'error' ? 'bg-red-50 border-l-4 border-red-400' : 'bg-green-50 border-l-4 border-green-400' }}">
                <div class="flex">
                    <div class="flex-shrink-0">
                        @if(session('alert-type') === 'error')
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                    <div class="ml-3">
                        <p class="text-sm {{ session('alert-type') === 'error' ? 'text-red-700' : 'text-green-700' }}">
                            {{ session('message') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('customer.enquiry.items.store') }}" method="POST" id="enquiryForm">
            @csrf
            <input type="hidden" name="enquiry_id" value="{{ $enquiryId }}">
            <input type="hidden" name="draft" value="0" id="draftStatus">
            @if($isEditMode)
                <input type="hidden" name="is_edit" value="1">
            @endif
            
            @if(!$enquiryId && !$isEditMode)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <div class="flex">
                        {{--  <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>  --}}
                        {{--  <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Please create an enquiry first before adding items.
                                <a href="{{ route('customer.enquiry') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                    Create Enquiry
                                </a>
                            </p>
                        </div>  --}}
                    </div>
                </div>
            @endif
            
            <!-- Company Info Row -->
            <div class="bg-gray-50 p-4 rounded-lg mb-4 flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">Company Name:</span>
                    <input type="text" name="companyname" id="companyname" value="{{ $customer->company_name ?? '' }}"
                        class="font-semibold bg-white px-3 py-1 border border-gray-300 rounded" readonly>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">Contact:</span>
                    <input type="text" name="contactnumber" id="contactnumber" value="{{ auth()->user()->phone ?? '' }}"
                        class="font-semibold bg-white px-3 py-1 border border-gray-300 rounded" readonly>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">Enquiry Number:</span>
                    <span class="font-semibold bg-white px-3 py-1 border border-gray-300 rounded">{{ $enquiryNumber ?? 'New Enquiry' }}</span>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300" id="enquiryTable">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2">Sl.No</th>
                            <th class="border border-gray-300 px-3 py-2">Item Name</th>
                            <th class="border border-gray-300 px-3 py-2">Item Description</th>
                            <th class="border border-gray-300 px-3 py-2">Manufacturer</th>
                            <th class="border border-gray-300 px-3 py-2">Qty</th>
                            <th class="border border-gray-300 px-3 py-2">Remarks</th>
                            @if(!$isViewMode)
                                <th class="border border-gray-300 px-3 py-2">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="enquiryTableBody">
                        @forelse($enquiryItems as $index => $item)
                            <tr>
                                <td class="border border-gray-300 px-3 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-3 py-2">
                                    @if($isEditMode)
                                        <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                                    @endif
                                    <select name="items[{{ $index }}][category_id]" 
                                        class="w-full border {{ $errors->has('items.'.$index.'.category_id') ? 'border-red-500' : 'border-gray-300' }} rounded px-2 py-1 item-select {{ $isViewMode ? 'bg-gray-50' : '' }}" 
                                        {{ $isViewMode ? 'disabled' : 'required' }}>
                                        <option value="">Select Item</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('items.'.$index.'.category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('items.'.$index.'.category_id')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border border-gray-300 px-3 py-2">
                                    <input type="text" 
                                        name="items[{{ $index }}][item_description]" 
                                        value="{{ old('items.'.$index.'.item_description', $item->item_description) }}"
                                        class="w-full border {{ $errors->has('items.'.$index.'.item_description') ? 'border-red-500' : 'border-gray-300' }} rounded px-2 py-1 item-description {{ $isViewMode ? 'bg-gray-50' : '' }}" 
                                        placeholder="Enter description" 
                                        {{ $isViewMode ? 'disabled' : 'required' }}>
                                    @error('items.'.$index.'.item_description')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border border-gray-300 px-3 py-2">
                                    <input type="text" 
                                        name="items[{{ $index }}][manufacturer]" 
                                        value="{{ old('items.'.$index.'.manufacturer', $item->manufacturer) }}"
                                        class="w-full border {{ $errors->has('items.'.$index.'.manufacturer') ? 'border-red-500' : 'border-gray-300' }} rounded px-2 py-1 manufacturer {{ $isViewMode ? 'bg-gray-50' : '' }}" 
                                        placeholder="Enter manufacturer" 
                                        {{ $isViewMode ? 'disabled' : 'required' }}>
                                    @error('items.'.$index.'.manufacturer')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border border-gray-300 px-3 py-2">
                                    <input type="number" 
                                        name="items[{{ $index }}][qty]" 
                                        value="{{ old('items.'.$index.'.qty', $item->qty) }}"
                                        class="w-full border {{ $errors->has('items.'.$index.'.qty') ? 'border-red-500' : 'border-gray-300' }} rounded px-2 py-1 quantity {{ $isViewMode ? 'bg-gray-50' : '' }}" 
                                        min="1" 
                                        {{ $isViewMode ? 'disabled' : 'required' }}>
                                    @error('items.'.$index.'.qty')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border border-gray-300 px-3 py-2">
                                    <input type="text" 
                                        name="items[{{ $index }}][remark]" 
                                        value="{{ old('items.'.$index.'.remark', $item->remark) }}"
                                        class="w-full border {{ $errors->has('items.'.$index.'.remark') ? 'border-red-500' : 'border-gray-300' }} rounded px-2 py-1 remarks {{ $isViewMode ? 'bg-gray-50' : '' }}" 
                                        placeholder="Enter remarks" 
                                        {{ $isViewMode ? 'disabled' : '' }}>
                                    @error('items.'.$index.'.remark')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </td>
                                @if(!$isViewMode)
                                    <td class="border border-gray-300 px-3 py-2">
                                        <button type="button" class="text-red-500 hover:text-red-700 delete-row" onclick="deleteRow(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            @if(!$isViewMode)
                                {{-- Initial row for new enquiry --}}
                                <tr>
                                    <td class="border border-gray-300 px-3 py-2">01</td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="items[0][category_id]" class="w-full border border-gray-300 rounded px-2 py-1 item-select @error('items.0.category_id') border-red-500 @enderror" required>
                                            <option value="">Select Item</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('items.0.category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('items.0.category_id')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="items[0][item_description]" value="{{ old('items.0.item_description') }}" 
                                            class="w-full border border-gray-300 rounded px-2 py-1 item-description @error('items.0.item_description') border-red-500 @enderror" 
                                            placeholder="Enter description" required>
                                        @error('items.0.item_description')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="items[0][manufacturer]" value="{{ old('items.0.manufacturer') }}"
                                            class="w-full border border-gray-300 rounded px-2 py-1 manufacturer @error('items.0.manufacturer') border-red-500 @enderror" 
                                            placeholder="Enter manufacturer" required>
                                        @error('items.0.manufacturer')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="items[0][qty]" value="{{ old('items.0.qty', 1) }}"
                                            class="w-full border border-gray-300 rounded px-2 py-1 quantity @error('items.0.qty') border-red-500 @enderror" 
                                            min="1" required>
                                        @error('items.0.qty')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="items[0][remark]" value="{{ old('items.0.remark') }}"
                                            class="w-full border border-gray-300 rounded px-2 py-1 remarks @error('items.0.remark') border-red-500 @enderror" 
                                            placeholder="Enter remarks">
                                        @error('items.0.remark')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <button type="button" class="text-red-500 hover:text-red-700 delete-row" onclick="deleteRow(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(!$isViewMode)
                <div>
                    <div class="bg-gray-50 p-9 rounded-md border border-gray-200 flex items-center gap-2 justify-end">
                        <button type="button" class="color text-white p-2 rounded-full" onclick="addNewRow()">Add New Item</button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mt-6">
                    <!-- Cancel Button (left) -->
                    <button
                        class="flex items-center gap-2 px-6 py-2 rounded-full border border-red-500 text-red-500 hover:bg-red-50 transition"
                        onclick="document.getElementById('cancel-modal').classList.remove('hidden')">
                        Cancel
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Save as Draft & Submit Buttons (right) -->
                    <div class="flex items-center gap-4">
                        <!-- Save as Draft -->
                        <button type="button"
                            class="flex items-center gap-2 px-6 py-2 rounded-full border border-gray-300 text-gray-800 hover:bg-gray-100 transition"
                            onclick="saveAsDraft()">
                            Save as Draft
                            <img src="{{ asset('frontend/assets/images/fi_9511664.png') }}" alt="Draft" class="w-5 h-5">
                        </button>

                        <!-- Submit Enquiry -->
                        <button type="submit" class="px-6 py-2 rounded-full color text-white hover:bg-orange-600 transition">
                            {{ $isEditMode ? 'Update Enquiry' : 'Submit Enquiry' }}
                        </button>
                    </div>
                </div>
            @else
                <div class="flex justify-end mt-6">
                    <button type="button" onclick="window.location.href='{{ route('enquiry.management') }}'"
                        class="px-6 py-2 rounded-full bg-gray-500 text-white hover:bg-gray-600 transition">
                        Back to Enquiries
                    </button>
                </div>
            @endif
        </form>
    </section>
@endsection

@push('scripts')
<script>
    let rowCounter = 1;
    const categories = @json($categories);

    function saveAsDraft() {
        document.getElementById('draftStatus').value = '1';
        document.getElementById('enquiryForm').submit();
    }

    // Show success modal if enquiry was submitted successfully
    @if(session('showSuccessModal'))
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('success-modal').classList.remove('hidden');
        });
    @endif

    function addNewRow() {
        rowCounter++;
        const tbody = document.getElementById('enquiryTableBody');
        const newRow = document.createElement('tr');

        // Create categories options HTML
        const categoryOptions = categories.map(category =>
            `<option value="${category.id}">${category.name}</option>`
        ).join('');

        newRow.innerHTML = `
            <td class="border border-gray-300 px-3 py-2">${String(rowCounter).padStart(2, '0')}</td>
            <td class="border border-gray-300 px-3 py-2">
                <select name="items[${rowCounter-1}][category_id]" class="w-full border border-gray-300 rounded px-2 py-1 item-select @error('items.${rowCounter-1}.category_id') border-red-500 @enderror" required>
                    <option value="">Select Item</option>
                    ${categoryOptions}
                </select>
                @error('items.${rowCounter-1}.category_id')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="text" name="items[${rowCounter-1}][item_description]" value="{{ old('items.${rowCounter-1}.item_description') }}"
                    class="w-full border border-gray-300 rounded px-2 py-1 item-description @error('items.${rowCounter-1}.item_description') border-red-500 @enderror" 
                    placeholder="Enter description" required>
                @error('items.${rowCounter-1}.item_description')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="text" name="items[${rowCounter-1}][manufacturer]" value="{{ old('items.${rowCounter-1}.manufacturer') }}"
                    class="w-full border border-gray-300 rounded px-2 py-1 manufacturer @error('items.${rowCounter-1}.manufacturer') border-red-500 @enderror" 
                    placeholder="Enter manufacturer" required>
                @error('items.${rowCounter-1}.manufacturer')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="number" name="items[${rowCounter-1}][qty]" value="{{ old('items.${rowCounter-1}.qty', 1) }}"
                    class="w-full border border-gray-300 rounded px-2 py-1 quantity @error('items.${rowCounter-1}.qty') border-red-500 @enderror" 
                    min="1" required>
                @error('items.${rowCounter-1}.qty')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="text" name="items[${rowCounter-1}][remark]" value="{{ old('items.${rowCounter-1}.remark') }}"
                    class="w-full border border-gray-300 rounded px-2 py-1 remarks @error('items.${rowCounter-1}.remark') border-red-500 @enderror" 
                    placeholder="Enter remarks">
                @error('items.${rowCounter-1}.remark')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <button type="button" class="text-red-500 hover:text-red-700 delete-row" onclick="deleteRow(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </td>
        `;

        tbody.appendChild(newRow);
        updateRowNumbers();
    }

    function deleteRow(button) {
        const row = button.closest('tr');
        if (document.getElementById('enquiryTableBody').rows.length > 1) {
            row.remove();
            updateRowNumbers();
        } else {
            toastr.warning('Cannot delete the last row! At least one item is required.');
        }
    }

    function updateRowNumbers() {
        const rows = document.getElementById('enquiryTableBody').getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            rows[i].cells[0].textContent = String(i + 1).padStart(2, '0');
        }
        rowCounter = rows.length;
    }

    // Add this to your existing JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Log form submission for debugging
        document.getElementById('enquiryForm').addEventListener('submit', function(e) {
            console.log('Form submitted with data:', new FormData(this));
        });

        // Show validation errors in console for debugging
        @if($errors->any())
            console.log('Validation errors:', @json($errors->all()));
        @endif
    });
</script>
@endpush

<!-- Basic Modal Structure for Cancel Confirmation -->
<div id="cancel-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex justify-center items-center">
    <div class="relative p-8 border w-full max-w-sm shadow-lg rounded-lg bg-white text-center">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
            <!-- Red Cross Icon -->
            <svg class="h-10 w-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <h3 class="text-xl leading-6 font-semibold text-gray-900 mb-4">Are you sure?</h3>
        <div class="mb-6">
            <p class="text-sm text-gray-500">Are you sure you want to cancel this doc?</p>
        </div>
        <div class="flex flex-col gap-3">
            <button id="yes-cancel-button" class="px-4 py-2 bg-orange-500 text-white text-base font-medium rounded-full shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition" onclick="window.location.href='{{ route('enquiry.management') }}'">
                Yes Cancel
            </button>
            <button id="continue-button" class="px-4 py-2 bg-white text-gray-800 text-base font-medium rounded-full shadow-sm border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 transition" onclick="document.getElementById('cancel-modal').classList.add('hidden')">
                Continue
            </button>
        </div>
    </div>
</div>

<!-- Basic Modal Structure for Success Confirmation -->
<!-- Success Modal with Fixed Checkmark -->
<div id="success-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex justify-center items-center">
    <div class="relative p-8 border w-full max-w-sm shadow-lg rounded-lg bg-white text-center">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
            <!-- Green Check Icon with fill -->
            <svg class="h-10 w-10 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <h3 class="text-xl leading-6 font-semibold text-gray-900 mb-4">Success!</h3>
        <div class="mb-6">
            <p class="text-sm text-gray-500">You have successfully submitted enquiry document</p>
        </div>
        <div class="flex justify-center">
            <button id="back-to-home-button" class="px-4 py-2 bg-orange-500 text-white text-base font-medium rounded-full shadow-sm hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition" onclick="window.location.href='{{ route('website') }}'">
                Back to Home
            </button>
        </div>
    </div>
</div>

<style>
/* Additional styles to ensure the modal displays properly */
#success-modal {
}

#success-modal .bg-green-100 {
    background-color: #dcfce7;
}

#success-modal .text-green-600 {
    color: #16a34a;
}

/* Animation for the checkmark */
#success-modal svg {
    animation: checkmark 0.6s ease-in-out;
}

@keyframes checkmark {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

</body>
