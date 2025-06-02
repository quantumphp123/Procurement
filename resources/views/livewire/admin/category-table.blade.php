<div>
    <div class="mb-3 d-flex justify-content-end">
        <input type="text" class="form-control form-control-sm w-auto me-2" style="max-width: 180px;"
            placeholder="Search..." wire:model.lazy="searchInput">
        <button class="btn btn-sm btn-primary" wire:click="applySearch">Search</button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $key => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $key }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" width="100"
                                style="max-height: 100px; object-fit: contain;">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}"
                            class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this?')"
                                class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
