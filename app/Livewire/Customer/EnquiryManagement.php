<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer\Enquiry;
use Illuminate\Support\Facades\Auth;

class EnquiryManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = '12'; // Default to This Year
    public $activeTab = 'all';
    public $showDeleteModal = false;
    public $enquiryToDeleteId = null;
    public $enquiryToDeleteNumber = null;
    public $deleteType = 'delete';

    protected $queryString = ['search', 'sort', 'activeTab'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function delete()
    {
        if ($this->enquiryToDeleteId) {
            $enquiry = Enquiry::where('user_id', Auth::id())->findOrFail($this->enquiryToDeleteId);
            $enquiry->delete(); // This will now soft delete
            
            session()->flash('message', 'Enquiry moved to trash successfully.');
            $this->cancelDelete(); // Hide modal after deletion
        }
    }

    public function restore($enquiryId)
    {
        $enquiry = Enquiry::withTrashed()
            ->where('user_id', Auth::id())
            ->findOrFail($enquiryId);
            
        $enquiry->restore();
        
        session()->flash('message', 'Enquiry restored successfully.');
    }

    public function forceDelete($enquiryId)
    {
        $enquiry = Enquiry::withTrashed()
            ->where('user_id', Auth::id())
            ->findOrFail($enquiryId);
            
        $enquiry->forceDelete();
        
        session()->flash('message', 'Enquiry permanently deleted.');
    }

    public function confirmDelete($enquiryId, $enquiryNumber, $type = 'delete')
    {
        $this->enquiryToDeleteId = $enquiryId;
        $this->enquiryToDeleteNumber = $enquiryNumber;
        $this->deleteType = $type;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->enquiryToDeleteId = null;
        $this->enquiryToDeleteNumber = null;
        $this->deleteType = 'delete';
    }

    public function render()
    {
        $query = Enquiry::where('user_id', Auth::id());

        // Apply search filter
        if ($this->search) {
            $query->where('enquiry_number', 'like', '%' . $this->search . '%');
        }

        // Apply date filter based on sort
        $query->when($this->sort, function ($q) {
            return match ($this->sort) {
                '7' => $q->where('created_at', '>=', now()->subDays(7)),
                '30' => $q->where('created_at', '>=', now()->subDays(30)),
                default => $q->where('created_at', '>=', now()->startOfYear()),
            };
        });

        // Apply tab filter
        $query->when($this->activeTab, function ($q) {
            return match ($this->activeTab) {
                'deleted' => $q->onlyTrashed(),
                'drafted' => $q->where('drafted', 1),
                default => $q->whereNull('deleted_at')->where('drafted', 0),
            };
        });

        $enquiries = $query->latest()->paginate(10);

        return view('livewire.customer.enquiry-management', [
            'enquiries' => $enquiries,
            'totalEnquiries' => Enquiry::where('user_id', Auth::id())->whereNull('deleted_at')->count()
        ]);
    }
} 