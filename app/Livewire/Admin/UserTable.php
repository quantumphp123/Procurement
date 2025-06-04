<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserTable extends Component
{
    use WithPagination;

    public $roleFilter = 'customer'; // default tab
    public $searchInput = '';
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearchInput()
    {
        $this->resetPage();
    }

    public function applySearch()
    {
        $this->search = $this->searchInput;
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        // Filter by role
        if ($this->roleFilter === 'customer') {
            $query->where('role_id', 2);
        } elseif ($this->roleFilter === 'vendor') {
            $query->where('role_id', 3);
        }

        // Search by name or email
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.user-table', [
            'users' => $users,
        ]);
    }
}