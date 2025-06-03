<div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="mb-3 d-flex justify-content-end">
                <input type="text" class="form-control form-control-sm w-auto me-2" style="max-width: 180px;"
                    placeholder="Search..." wire:model.lazy="searchInput">
                <button class="btn btn-sm btn-primary" wire:click="applySearch">Search</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <select wire:model.live="perPage" class="form-control">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th wire:click="sortBy('name')" style="cursor: pointer;">
                        Name
                        @if($sortField === 'name')
                            @if($sortDirection === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('status')" style="cursor: pointer;">
                        Status
                        @if($sortField === 'status')
                            @if($sortDirection === 'asc')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort-down"></i>
                            @endif
                        @endif
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($units as $unit)
                    <tr>
                        <td>{{ $units->firstItem() + $key }}</td>
                        <td>{{ $unit->name }}</td>
                        <td>
                            <button wire:click="toggleStatus({{ $unit->id }})" 
                                    class="btn btn-sm {{ $unit->status ? 'btn-success' : 'btn-danger' }}">
                                {{ $unit->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.units.edit', $unit) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button wire:click="deleteUnit({{ $unit->id }})" 
                                        class="btn btn-sm btn-danger"
                                        onclick="confirm('Are you sure you want to delete this unit?') || event.stopImmediatePropagation()">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No units found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $units->links() }}
    </div>

 
</div> 