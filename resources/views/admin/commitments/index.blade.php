@extends('admin.layouts.app')

@section('title', 'Commitments Management')
@section('page-title', 'Commitments Management')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Commitments</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Commitments Management</h1>
            <p class="text-gray-600 mt-1">Manage eco-tourism practices and sustainability commitments</p>
        </div>
        <a href="{{ route('admin.commitments.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add New Commitment
        </a>
    </div>

    <!-- Commitments List -->
    @if($commitments->count() > 0)
        <div id="commitments-list" class="space-y-4">
            @foreach($commitments as $commitment)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200" data-id="{{ $commitment->id }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Drag Handle -->
                            <i class="fas fa-grip-vertical text-gray-400 cursor-move"></i>
                            
                            <!-- Icon -->
                            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="{{ $commitment->icon }} text-emerald-600 text-xl"></i>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $commitment->title }}</h3>
                                <p class="text-sm text-gray-500">Order: {{ $commitment->sort_order }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Status -->
                            @if($commitment->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Inactive
                                </span>
                            @endif

                            <!-- Actions -->
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.commitments.edit', $commitment) }}" 
                                   class="text-emerald-600 hover:text-emerald-800 transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteCommitment({{ $commitment->id }})" 
                                        class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="text-center py-12">
                <i class="fas fa-leaf text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Commitments Found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first commitment.</p>
                <a href="{{ route('admin.commitments.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Add First Commitment
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
            <h3 class="text-lg font-medium text-gray-900">Delete Commitment</h3>
        </div>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this commitment? This action cannot be undone.</p>
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
    // Make list sortable
    const list = document.getElementById('commitments-list');
    if (list) {
        new Sortable(list, {
            animation: 150,
            handle: '.fa-grip-vertical',
            onEnd: function(evt) {
                updateOrder();
            }
        });
    }

    function updateOrder() {
        const items = document.querySelectorAll('#commitments-list > div');
        const commitments = [];
        
        items.forEach((item, index) => {
            commitments.push({
                id: item.dataset.id,
                sort_order: index + 1
            });
        });

        fetch('{{ route("admin.commitments.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ commitments: commitments })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update sort order display
                items.forEach((item, index) => {
                    item.querySelector('p').textContent = `Order: ${index + 1}`;
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteCommitment(id) {
        document.getElementById('deleteForm').action = `/admin/commitments/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
@endpush
