@extends('seller.layouts.seller', ['pageTitle' => 'My Enquires', 'breadcrumbTitle' => 'Enquiries', 'breadcrumbRoute' => 'seller.enquiries.index', 'breadcrumbCurrent' => 'view'])

@section('title', 'View/Edit Enquiry Quote | Procurement Dashboard')

@section('content')
    <!-- Success Modal -->
    <div id="successModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 max-w-md w-full">
            <div class="flex flex-col items-center justify-center px-4 pb-4 text-center space-y-6">
                <!-- Success Icon with Sparkles -->
                <div class="relative w-20 h-20 flex items-center p-2 justify-center bg-green-100 rounded-full">
                    <img src="{{ asset('img/icons/success-tick.svg') }}" class="animate-fade" alt="Success icon">
                    <svg class="absolute w-4 h-4 text-green-500 animate-ping bottom-2 -left-[20px]" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 0l2 4 4 2-4 2-2 4-2-4-4-2 4-2z" />
                    </svg>
                    <svg class="absolute w-4 h-4 text-green-500 animate-ping top-0 right-0" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 0l2 4 4 2-4 2-2 4-2-4-4-2 4-2z" />
                    </svg>
                </div>
                <div class="text-base sm:text-lg text-gray-800 dark:text-gray-400">
                    You have successfully sent quotation for <br />
                    <span class="font-semibold">Enq No : <span
                            class="text-black dark:text-gray-100">{{ $enquiry->enquiry_number }}</span></span>
                </div>
                <a href="{{ route('seller.enquiries.index') }}"
                    class="inline-block bg-orange-500 hover:bg-[#000000] transition duration-300 ease-in-out text-white font-medium py-3 px-10 rounded-full text-sm sm:text-base">
                    Back to Enquiries
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white pt-4 px-4 rounded-t-lg dark:bg-gray-900">
        <!-- Customer Info  -->
        <div
            class="bg-gray-100 border border-gray-300 p-4 rounded-lg w-full mx-auto text-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-wrap gap-4 lg:justify-between text-black dark:text-gray-300">
                <!-- Company Name -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-900 whitespace-nowrap dark:text-gray-400">Company
                        Name:</span>
                    <span
                        class="bg-gray-300 px-4 py-2 rounded-md font-semibold dark:bg-gray-600">{{ $enquiry->user->name ?? 'N/A' }}</span>
                </div>
                <!-- Contact -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-900 whitespace-nowrap dark:text-gray-400">Contact:</span>
                    <span
                        class="bg-gray-300 px-4 py-2 rounded-md font-semibold dark:bg-gray-600">{{ $enquiry->contact_number ?? ($enquiry->user->phone ?? 'N/A') }}</span>
                </div>
                <!-- Enquiry Number -->
                <div class="flex items-center space-x-2">
                    <span class="text-gray-900 whitespace-nowrap dark:text-gray-400">Enquiry
                        Number:</span>
                    <span
                        class="bg-gray-300 px-4 py-2 rounded-md font-semibold dark:bg-gray-600">{{ $enquiry->enquiry_number }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Table -->
    <div class="w-full overflow-hidden bg-white px-4 py-5 dark:bg-gray-900">
        <div class="w-full overflow-x-auto">
            <table class="w-full border">
                <!-- Table Head  -->
                <thead>
                    <tr
                        class="text-sm font-semibold border tracking-wide text-black-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">SL No.</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Item's Name</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Qty</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Remarks</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Unit Price</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Total Price</th>
                        <th scope="col" class="px-4 py-3 border dark:border-gray-700">Action</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center text-sm text-black dark:text-gray-400">
                    @foreach ($enquiry->enquiry_items as $index => $item)
                        <tr data-enquiry-item-id="{{ $item->id }}">
                            <td class="px-4 py-3 border dark:border-gray-700">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                                {{ $item->category->name ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3 border dark:border-gray-700 quantity-cell">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-4 py-3 border dark:border-gray-700 max-w-xs">
                                <div class="truncate-text">
                                    {{ $item->remark ?? 'No remarks' }}
                                </div>
                            </td>
                            <td class="px-4 py-3 border dark:border-gray-700">
                                <span class="priceStatic">$0.0</span>
                                <span contenteditable="true"
                                    class="priceEditable hidden ml-1 inline-block bg-white px-2 py-1 min-w-[40px] rounded-md dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-2 focus:border-gray-800 focus:ring-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600"
                                    title="Click to edit">
                                </span>
                                <input type="hidden" name="items[{{ $index }}][enquiry_item_id]"
                                    value="{{ $item->id }}">
                                <input type="hidden" name="items[{{ $index }}][unit_price]"
                                    class="unit-price-input" value="0">
                                <input type="hidden" name="items[{{ $index }}][quantity]"
                                    value="{{ $item->quantity }}">
                            </td>
                            <td class="px-4 py-3 border dark:border-gray-700 total-price-cell">$0.0</td>
                            <td class="px-4 py-3 border dark:border-gray-700">
                                <button type="button" title="Edit" onclick="toggleEditSave(this)"
                                    class="editSaveBtn mt-2 flex items-center justify-center mx-auto w-[60px] px-3 py-1 text-sm font-medium text-white bg-orange-500 rounded transition-all duration-200 hover:bg-orange-600">
                                    <svg class="editIcon w-4 h-4" aria-hidden="true" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                    <span class="saveText hidden text-xs">Save</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bill Form -->
    <div class="bg-white rounded-b-lg pb-5 mb-4 dark:bg-gray-900">
        <div
            class="flex flex-col mx-4 md:flex-row justify-between gap-6 p-6 bg-gray-100 rounded-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-600">

            <!-- Left Column -->
            <div class="mb-3 md:mb-0 text-md">
                <p class="text-gray-800 dark:text-gray-400">
                    <span class="font-medium">Delivery date:</span>
                    <span
                        class="font-semibold">{{ $enquiry->enquiry_items->first()->delivery_date
                            ? \Carbon\Carbon::parse($enquiry->enquiry_items->first()->delivery_date)->format('d/m/Y')
                            : 'N/A' }}</span>
                </p>

            </div>

            <!-- Right Section: col2 + col3 -->
            <div class="flex flex-col lg:flex-row gap- md:gap-12 text-gray-700 w-full">

                <!-- Column 2 -->
                <div class="flex-1 space-y-4">
                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">Total Price:</span>
                        <span class="text-lg font-semibold text-black dark:text-gray-300" id="totalPrice">$0.00</span>
                    </div>

                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">Discount:</span>
                        <input type="text" value="8%" id="discountInput"
                            class="w-20 text-right px-3 py-1 border border-gray-300 rounded-md font-semibold
         focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800
         dark:bg-gray-800 dark:text-white dark:border-gray-600
         dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                    </div>

                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">Discounted Price:</span>
                        <span class="text-lg font-semibold text-black dark:text-gray-300"
                            id="discountedPrice">$0.00</span>
                    </div>
                </div>

                <!-- Column 3 -->
                <div class="flex-1 space-y-4">
                    <div class="flex justify-between items-center h-10">
                        <span class="font-medium dark:text-gray-400">VAT:</span>
                        <input type="text" value="8%" id="vatInput"
                            class="w-20 text-right px-3 py-1 border border-gray-300 rounded-md font-semibold
         focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800
         dark:bg-gray-800 dark:text-white dark:border-gray-600
         dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                    <div class="flex items-center h-10">
                        <div class="w-full border-b border-gray-300 dark:border-gray-600"></div>
                    </div>

                    <div class="flex justify-between items-center h-10">
                        <span class="text-lg font-semibold text-black dark:text-white">Final
                            Price:</span>
                        <span class="text-lg font-bold text-orange-800 dark:text-gray-100" id="finalPrice">$0.00</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Buttons -->
        <div class="flex border-t border-gray-300 mt-4 mx-4 pt-4 flex-wrap justify-center gap-6 dark:border-gray-700">

            <button onclick="declineEnquiry()"
                class="flex w-48 items-center justify-center px-6 py-2 bg-red-600 text-base font-semibold text-white border-2 border-red-600 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105">

                <div class="p-1 mr-1 rounded-full text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white hover:text-red-600 cursor-pointer"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
                <span>Decline</span>
            </button>
            <button onclick="submitQuotation()"
                class="px-6 py-2 w-48 bg-orange-600 text-base font-semibold text-white border-2 border-orange-600 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105">
                Submit Quote
            </button>

        </div>
    </div>

    <script>
        function toggleEditSave(button) {
            const row = button.closest("tr");
            const priceStatic = row.querySelector(".priceStatic");
            const priceEditable = row.querySelector(".priceEditable");
            const editIcon = button.querySelector(".editIcon");
            const saveText = button.querySelector(".saveText");
            const unitPriceInput = row.querySelector(".unit-price-input");

            if (editIcon.classList.contains("hidden")) {
                // Save mode
                editIcon.classList.remove("hidden");
                saveText.classList.add("hidden");

                const newPrice = parseFloat(priceEditable.textContent.trim()) || 0;
                priceStatic.textContent = "$" + newPrice.toFixed(1);
                priceStatic.classList.remove("hidden");
                priceEditable.classList.add("hidden");

                unitPriceInput.value = newPrice;

                updateRowTotal(row, newPrice);
                updateGrandTotal();

                // Remove focus from the editable element
                priceEditable.blur();
            } else {
                // Edit mode
                editIcon.classList.add("hidden");
                saveText.classList.remove("hidden");

                const currentPrice = priceStatic.textContent.replace("$", "").trim();
                priceEditable.textContent = currentPrice === "0.0" ? "" : currentPrice;
                priceStatic.classList.add("hidden");
                priceEditable.classList.remove("hidden");

                // Focus and select all text for easy editing
                priceEditable.focus();

                // Select all text if there's content
                if (priceEditable.textContent.trim()) {
                    const range = document.createRange();
                    range.selectNodeContents(priceEditable);
                    const sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);
                }
            }
        }

        // Add event listeners for better UX on contenteditable fields
        document.addEventListener('DOMContentLoaded', function() {
            // Handle Enter key press to save
            document.addEventListener('keydown', function(e) {
                if (e.target.classList.contains('priceEditable') && e.key === 'Enter') {
                    e.preventDefault();
                    const row = e.target.closest('tr');
                    const saveButton = row.querySelector('.editSaveBtn');
                    toggleEditSave(saveButton);
                }
            });

            // Handle Escape key to cancel editing
            document.addEventListener('keydown', function(e) {
                if (e.target.classList.contains('priceEditable') && e.key === 'Escape') {
                    e.preventDefault();
                    const row = e.target.closest('tr');
                    const saveButton = row.querySelector('.editSaveBtn');
                    const priceStatic = row.querySelector('.priceStatic');
                    const priceEditable = row.querySelector('.priceEditable');
                    const editIcon = saveButton.querySelector('.editIcon');
                    const saveText = saveButton.querySelector('.saveText');

                    // Cancel edit mode
                    editIcon.classList.remove("hidden");
                    saveText.classList.add("hidden");
                    priceStatic.classList.remove("hidden");
                    priceEditable.classList.add("hidden");
                }
            });

            // Prevent non-numeric input (allow only numbers and decimal point)
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('priceEditable')) {
                    let value = e.target.textContent;
                    // Remove any non-numeric characters except decimal point
                    value = value.replace(/[^0-9.]/g, '');
                    // Ensure only one decimal point
                    const parts = value.split('.');
                    if (parts.length > 2) {
                        value = parts[0] + '.' + parts.slice(1).join('');
                    }
                    if (value !== e.target.textContent) {
                        e.target.textContent = value;
                        // Move cursor to end
                        const range = document.createRange();
                        const sel = window.getSelection();
                        range.selectNodeContents(e.target);
                        range.collapse(false);
                        sel.removeAllRanges();
                        sel.addRange(range);
                    }
                }
            });
        });

        function updateRowTotal(row, unitPrice) {
            const quantityCell = row.cells[2];
            const totalCell = row.querySelector('.total-price-cell');
            const quantity = parseFloat(quantityCell.textContent.trim()) || 0;
            const total = unitPrice * quantity;
            totalCell.textContent = "$" + total.toFixed(2);
        }

        function updateGrandTotal() {
            const totalCells = document.querySelectorAll('.total-price-cell');
            let grandTotal = 0;

            totalCells.forEach(cell => {
                const value = parseFloat(cell.textContent.replace('$', '')) || 0;
                grandTotal += value;
            });

            document.getElementById('totalPrice').textContent = "$" + grandTotal.toFixed(2);

            const discountInput = document.getElementById('discountInput');
            const discountPercent = parseFloat(discountInput.value.replace('%', '')) || 0;
            const discountedPrice = grandTotal - (grandTotal * discountPercent / 100);
            document.getElementById('discountedPrice').textContent = "$" + discountedPrice.toFixed(2);

            const vatInput = document.getElementById('vatInput');
            const vatPercent = parseFloat(vatInput.value.replace('%', '')) || 0;
            const finalPrice = discountedPrice + (discountedPrice * vatPercent / 100);
            document.getElementById('finalPrice').textContent = "$" + finalPrice.toFixed(2);
        }

        // Update totals when discount or VAT changes
        document.addEventListener('DOMContentLoaded', function() {
            const discountInput = document.getElementById('discountInput');
            const vatInput = document.getElementById('vatInput');

            if (discountInput) {
                discountInput.addEventListener('input', updateGrandTotal);
            }

            if (vatInput) {
                vatInput.addEventListener('input', updateGrandTotal);
            }
        });

        function submitQuotation() {
            const submitButton = document.querySelector('button[onclick="submitQuotation()"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = 'Submitting...';
            submitButton.disabled = true;

            const items = [];
            const rows = document.querySelectorAll('tbody tr');

            for (const row of rows) {
                const enquiryItemId = row.querySelector('input[name*="enquiry_item_id"]').value;
                const unitPrice = row.querySelector('.unit-price-input').value;
                const quantity = row.querySelector('input[name*="quantity"]').value;
                const itemName = row.cells[1].textContent.trim();

                if (parseFloat(unitPrice) <= 0) {
                    toastr.error(`Please set a unit price for item: ${itemName}`);
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                    return;
                }

                items.push({
                    enquiry_item_id: parseInt(enquiryItemId),
                    unit_price: parseFloat(unitPrice),
                    quantity: parseInt(quantity),
                    item_name: itemName
                });
            }

            if (items.length === 0) {
                toastr.error(`No valid items to submit.`);
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                return;
            }

            const discountPercentage = parseFloat(document.getElementById('discountInput').value.replace('%', '')) || 0;
            const vatPercentage = parseFloat(document.getElementById('vatInput').value.replace('%', '')) || 0;

            const formData = {
                items: items,
                discount_percentage: discountPercentage,
                vat_percentage: vatPercentage
            };

            fetch('{{ route('seller.enquiries.submit-quotation', $enquiry->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        const successModal = document.getElementById('successModal');
                        if (successModal) {
                            successModal.classList.remove('hidden');
                            successModal.classList.add('flex');
                        } else {
                            window.location.href = '{{ route('seller.enquiries.index') }}';
                        }
                    } else {
                        toastr.error('Error: ' + (data.message || 'Something went wrong.'));
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    toastr.error("Failed to submit quotation. Please try again.");
                })
                .finally(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
        }

        function declineEnquiry() {
            // Show confirmation dialog
            if (!confirm('Are you sure you want to decline this enquiry? This action cannot be undone.')) {
                return;
            }

            const declineButton = document.querySelector('button[onclick="declineEnquiry()"]');
            const originalText = declineButton.innerHTML;

            // Update button state
            declineButton.innerHTML = 'Declining...';
            declineButton.disabled = true;

            // Make the API call to decline the enquiry
            fetch('{{ route('seller.enquiries.decline', $enquiry->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        toastr.success(data.message || 'Enquiry declined successfully!');
                        // Redirect after a short delay
                        setTimeout(() => {
                            window.location.href = data.redirect || '{{ route('seller.enquiries.index') }}';
                        }, 1500);
                    } else {
                        toastr.error('Error: ' + (data.message || 'Failed to decline enquiry.'));
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    toastr.error("Failed to decline enquiry. Please try again.");
                })
                .finally(() => {
                    // Restore button state
                    declineButton.innerHTML = originalText;
                    declineButton.disabled = false;
                });
        }
    </script>

@endsection
