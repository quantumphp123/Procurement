<div>
    <!-- Top bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between bg-[#EFF4FF] px-6 py-5 rounded-t-3xl gap-6 sm:gap-0 p-4">
        <div class="flex gap-6">
            <button aria-current="page"
                class="flex items-center gap-2 bg-[#3b5de7] text-white rounded-lg p-4 text-xl font-semibold leading-5"
                onclick="window.location.href='{{ route('enquiry.management') }}'">
                <img alt="Clipboard with upward arrow icon" class="w-5 h-5" height="20" loading="lazy"
                    src="{{ asset('frontend/assets/images/myEnquiryvector.png') }}" width="20" />
                My Enquiries
            </button>
            <button class="flex items-center gap-2 text-[#9ca3af] text-xl font-normal leading-5 p-4"
                onclick="window.location.href='{{ route('my.quotation') }}'">
                <img alt="Envelope with dollar sign icon" class="w-5 h-5" height="20" loading="lazy"
                    src="{{ asset('frontend/assets/images/mailvector.png') }}" width="20" />
                My Quotations
            </button>
        </div>
        <div class="relative rounded-2xl w-48 h-30 bg-gradient-to-r from-[#3b5de7] to-[#1a1c3d] flex flex-col justify-center text-right px-6"
            style="box-shadow: inset -20px 0 40px rgb(255 255 255 / 0.15)">
            <div class="uppercase text-xs font-semibold tracking-widest leading-4 text-white">
                Total Enquiries
            </div>
            <div class="font-extrabold text-3xl leading-[38px] mt-2 text-white">
                {{ $totalEnquiries }}
            </div>
            <div>
                <select wire:model.live="sort" name="sort" id="sort"
                    class="text-gray-400 text-sm border-gray-400 border-2 p-1 rounded-full mt-2">
                    <option value="12">This Year</option>
                    <option value="30">This Month</option>
                    <option value="7">This Week</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tabs and search -->
    <div class="flex flex-col sm:flex-row items-center justify-between px-20 pt-4 pb-4 border-b border-gray-200">
        <nav class="flex gap-8 text-sm font-normal leading-5">
            <button wire:click="setActiveTab('all')" 
                class="{{ $activeTab === 'all' ? 'text-[#3b5de7] font-semibold border-b-2 border-[#3b5de7] pb-1' : 'text-[#1f2937]' }}">
                All Enquiries
            </button>
            <button wire:click="setActiveTab('deleted')"
                class="{{ $activeTab === 'deleted' ? 'text-[#3b5de7] font-semibold border-b-2 border-[#3b5de7] pb-1' : 'text-[#1f2937]' }}">
                Deleted
            </button>
            <button wire:click="setActiveTab('drafted')"
                class="{{ $activeTab === 'drafted' ? 'text-[#3b5de7] font-semibold border-b-2 border-[#3b5de7] pb-1' : 'text-[#1f2937]' }}">
                Drafted
            </button>
        </nav>
        <div class="mt-4 sm:mt-0 w-full sm:w-auto">
            <div class="flex items-center border border-gray-300 rounded-full px-4 py-2 text-gray-400 text-sm leading-5">
                <i class="fas fa-search mr-2 text-gray-400"></i>
                <input wire:model.live.debounce.300ms="search"
                    class="bg-transparent focus:outline-none w-full text-xs text-gray-400 placeholder:text-gray-400"
                    placeholder="Search Enquiry number" type="search" />
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto px-20 pt-4 pb-4">
        <table class="w-full text-xs text-[#1f2937]">
            <thead>
                <tr class="bg-[#ffe6b3] text-[#4b4b4b] font-semibold leading-5 text-left">
                    <th class="py-3 px-4 min-w-[60px]">Sl.No</th>
                    <th class="py-3 px-4 min-w-[140px]">Enquiry Number</th>
                    <th class="py-3 px-4 min-w-[140px]">Enquiry Date</th>
                    <th class="py-3 px-4 min-w-[100px]">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $index => $enquiry)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-[#f0f5ff]' }}">
                        <td class="py-3 px-4 font-normal">{{ $enquiries->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-normal">{{ $enquiry->enquiry_number }}</td>
                        <td class="py-3 px-4 font-normal">{{ $enquiry->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4 flex gap-2">
                           @if($activeTab !== 'deleted')
                           <button aria-label="View enquiry {{ $enquiry->enquiry_number }}"
                                class="bg-[#f9735b] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                onclick="window.location.href='{{ route('submit.enquiry.form', ['id' => $enquiry->id, 'view' => true]) }}'">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                           @endif
                            @if($activeTab === 'deleted')
                                <button wire:click="confirmDelete({{ $enquiry->id }}, '{{ $enquiry->enquiry_number }}', 'restore')"
                                    aria-label="Restore enquiry {{ $enquiry->enquiry_number }}"
                                    class="bg-[#3b5de7] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-undo text-xs"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $enquiry->id }}, '{{ $enquiry->enquiry_number }}', 'permanent')"
                                    aria-label="Permanently delete enquiry {{ $enquiry->enquiry_number }}"
                                    class="bg-[#ef4444] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            @else
                                <button aria-label="Edit enquiry {{ $enquiry->enquiry_number }}"
                                    class="bg-[#3b5de7] text-white rounded-md w-7 h-7 flex items-center justify-center"
                                    onclick="window.location.href='{{ route('submit.enquiry.form', ['id' => $enquiry->id, 'edit' => true]) }}'">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $enquiry->id }}, '{{ $enquiry->enquiry_number }}', 'delete')" 
                                    aria-label="Delete enquiry {{ $enquiry->enquiry_number }}"
                                    class="bg-[#ef4444] text-white rounded-md w-7 h-7 flex items-center justify-center">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                            No enquiries found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="flex flex-col sm:flex-row items-center justify-between py-4 text-[11px] font-extrabold leading-4 text-[#1f2937] px-20 pt-4 pb-4">
        <div>
            Showing {{ $enquiries->firstItem() ?? 0 }}–{{ $enquiries->lastItem() ?? 0 }} of {{ $enquiries->total() }} results
        </div>
        <div>
            {{ $enquiries->links() }}
        </div>
    </div>

    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-25">
            <div class="bg-white rounded-lg p-6 max-w-sm mx-auto text-center">
                <div class="flex justify-end">
                    <button wire:click="cancelDelete" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mb-4">
                    <i class="fas fa-trash-alt text-gray-400 text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">
                    @if($deleteType === 'permanent')
                        Permanently Delete Enquiry?
                    @elseif($deleteType === 'restore')
                        Restore Enquiry?
                    @else
                        Delete Enquiry?
                    @endif
                </h3>
                <p class="text-gray-600 mb-6">
                    @if($deleteType === 'permanent')
                        Are you sure you want to permanently delete enquiry for <strong>{{ $enquiryToDeleteNumber }}</strong>? This action cannot be undone.
                    @elseif($deleteType === 'restore')
                        Are you sure you want to restore enquiry for <strong>{{ $enquiryToDeleteNumber }}</strong>?
                    @else
                        Are you sure you want to delete enquiry for <strong>{{ $enquiryToDeleteNumber }}</strong>?
                    @endif
                </p>
                <div class="flex justify-center gap-4">
                    <button wire:click="cancelDelete"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Cancel</button>
                    <button wire:click="{{ $deleteType === 'restore' ? 'restore(' . $enquiryToDeleteId . ')' : 'delete' }}" wire:loading.attr="disabled"
                        class="px-4 py-2 {{ $deleteType === 'restore' ? 'bg-[#3b5de7] hover:bg-[#2d4bd6]' : 'bg-red-600 hover:bg-red-700' }} text-white rounded-md disabled:opacity-50 disabled:cursor-not-allowed">
                        @if($deleteType === 'restore')
                            Yes, Restore
                        @else
                            Yes, {{ $deleteType === 'permanent' ? 'Permanently Delete' : 'Delete' }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    @endif
</div> 