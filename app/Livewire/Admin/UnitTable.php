<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class UnitTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $listeners = ['unitUpdated' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteUnit($unitId)
    {
        $unit = Unit::findOrFail($unitId);
        
        if ($unit->enquiryItems()->exists()) {
            session()->flash('message', 'Unit cannot be deleted as it is being used in enquiry items.');
            session()->flash('alert-type', 'error');
            return;
        }

        $unit->delete();
        session()->flash('message', 'Unit deleted successfully.');
        session()->flash('alert-type', 'success');
    }

    public function toggleStatus($unitId)
    {
        $unit = Unit::findOrFail($unitId);
        $unit->update(['status' => !$unit->status]);
        
        session()->flash('message', 'Unit status updated successfully.');
        session()->flash('alert-type', 'success');
    }

    public function render()
    {
        $units = Unit::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.unit-table', [
            'units' => $units
        ]);
    }
} 