@extends('admin.layouts.app')

@section('title', 'Amenities Management')
@section('page-title', 'Amenities Management')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Amenities</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Amenities Management</h1>
            <p class="text-gray-600 mt-1 text-sm sm:text-base">Manage facility amenities and services</p>
        </div>
        <a href="{{ route('admin.amenities.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200 text-sm sm:text-base">
            <i class="fas fa-plus mr-2"></i>
            + Add New
        </a>
    </div>

    <!-- Amenities Grid -->
    @if($amenities->count() > 0)
        <div id="amenities-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($amenities as $amenity)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200" data-id="{{ $amenity->id }}">
                    <!-- Drag Handle -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-grip-vertical text-gray-400 cursor-move mr-3"></i>
                            <span class="text-sm text-gray-500">Order: {{ $amenity->sort_order }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($amenity->is_active)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Icon and Content -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="{{ $amenity->icon }} text-emerald-600 text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $amenity->title }}</h3>
                            @if($amenity->subtitle)
                                <p class="text-sm text-gray-600">{{ $amenity->subtitle }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.amenities.edit', $amenity) }}" 
                           class="text-emerald-600 hover:text-emerald-800 transition-colors duration-200">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="deleteAmenity({{ $amenity->id }})" 
                                class="text-red-600 hover:text-red-800 transition-colors duration-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="text-center py-12">
                <i class="fas fa-concierge-bell text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Amenities Found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first amenity.</p>
                <a href="{{ route('admin.amenities.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    + Add New
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex items-center mb-4">
            <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
            <h3 class="text-lg font-medium text-gray-900">Delete Amenity</h3>
        </div>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this amenity? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Cancel
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Make grid sortable
    const grid = document.getElementById('amenities-grid');
    if (grid) {
        new Sortable(grid, {
            animation: 150,
            handle: '.fa-grip-vertical',
            onEnd: function(evt) {
                updateOrder();
            }
        });
    }

    function updateOrder() {
        const cards = document.querySelectorAll('#amenities-grid > div');
        const amenities = [];
        
        cards.forEach((card, index) => {
            amenities.push({
                id: card.dataset.id,
                sort_order: index + 1
            });
        });

        fetch('{{ route("admin.amenities.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ amenities: amenities })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update sort order display
                cards.forEach((card, index) => {
                    card.querySelector('span').textContent = `Order: ${index + 1}`;
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteAmenity(id) {
        document.getElementById('deleteForm').action = `/admin/amenities/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
@endpush
