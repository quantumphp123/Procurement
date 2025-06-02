<div>
    <div class="mb-3 d-flex justify-content-end">
        <input type="text" class="form-control form-control-sm w-auto me-2" style="max-width: 180px;"
            placeholder="Search..." wire:model.lazy="searchInput">
        <button class="btn btn-sm btn-primary" wire:click="applySearch">Search</button>
    </div>


    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" id="userTabs" role="tablist">
        <li class="nav-item">
            <button wire:click="$set('roleFilter', 'customer')"
                class="nav-link {{ $roleFilter === 'customer' ? 'active' : '' }}" id="customer-tab" type="button"
                role="tab">
                Customers
            </button>
        </li>
        <li class="nav-item">
            <button wire:click="$set('roleFilter', 'vendor')"
                class="nav-link {{ $roleFilter === 'vendor' ? 'active' : '' }}" id="vendor-tab" type="button"
                role="tab">
                Vendors
            </button>
        </li>
    </ul>

    <!-- Table Content -->
    <div class="tab-content">
        <div class="tab-pane fade show active">
            <h5>{{ ucfirst($roleFilter) }} List</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role_id == 2)
                                    <span class="badge bg-success text-white fw-bold">Customer</span>
                                @elseif ($user->role_id == 3)
                                    <span class="badge bg-success text-white fw-bold">Vendor</span>
                                @else
                                    <span class="badge bg-secondary fw-bold">Other</span>
                                @endif
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}

        </div>
    </div>
</div>
