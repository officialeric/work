@extends('admin.layouts.app')

@section('title', 'Activities Management')
@section('page-title', 'Activities Management')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-golden-600 hover:text-golden-800">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Activities</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Activities Management</h1>
            <p class="text-gray-600 mt-1 text-sm sm:text-base">Manage the 7 featured activities for Saadani Kasa Bay</p>
        </div>
        <a href="{{ route('admin.activities.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-golden-600 text-white font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200 text-sm sm:text-base">
            <i class="fas fa-plus mr-2"></i>
            + Add New
        </a>
    </div>

    <!-- Activities List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        @if($activities->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-grip-vertical mr-2"></i>Order
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Activity
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Number
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="activities-tbody" class="bg-white divide-y divide-gray-200">
                        @foreach($activities as $activity)
                            <tr class="hover:bg-gray-50 transition-colors duration-200" data-id="{{ $activity->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-grip-vertical text-gray-400 cursor-move mr-3"></i>
                                        <span class="text-sm font-medium text-gray-900">{{ $activity->sort_order }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($activity->image)
                                            <img src="{{ $activity->image_url }}" 
                                                 alt="{{ $activity->title }}" 
                                                 class="w-12 h-12 rounded-lg object-cover mr-4">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $activity->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($activity->description, 60) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($activity->number)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-golden-100 text-golden-800">
                                            {{ $activity->number }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($activity->is_active)
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.activities.edit', $activity) }}" 
                                           class="text-golden-600 hover:text-golden-900 transition-colors duration-200">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="deleteActivity({{ $activity->id }})" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden" id="activities-mobile">
                @foreach($activities as $activity)
                    <div class="border-b border-gray-200 p-4 hover:bg-gray-50 transition-colors duration-200" data-id="{{ $activity->id }}">
                        <div class="flex items-start space-x-4">
                            <!-- Drag Handle -->
                            <div class="flex-shrink-0 pt-1">
                                <i class="fas fa-grip-vertical text-gray-400 cursor-move"></i>
                            </div>

                            <!-- Activity Image -->
                            <div class="flex-shrink-0">
                                @if($activity->image)
                                    <img src="{{ $activity->image_url }}"
                                         alt="{{ $activity->title }}"
                                         class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Activity Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-medium text-gray-900 truncate">{{ $activity->title }}</h3>
                                        <p class="text-xs text-gray-500 mt-1">{{ Str::limit($activity->description, 80) }}</p>

                                        <div class="flex items-center space-x-4 mt-2">
                                            <span class="text-xs text-gray-500">Order: {{ $activity->sort_order }}</span>

                                            @if($activity->number)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-golden-100 text-golden-800">
                                                    {{ $activity->number }}
                                                </span>
                                            @endif

                                            @if($activity->is_active)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times-circle mr-1"></i>
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2 ml-2">
                                        <a href="{{ route('admin.activities.edit', $activity) }}"
                                           class="p-2 text-golden-600 hover:text-golden-900 hover:bg-golden-50 rounded-lg transition-colors duration-200">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <button onclick="deleteActivity({{ $activity->id }})"
                                                class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors duration-200">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-hiking text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Activities Found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first activity.</p>
                <a href="{{ route('admin.activities.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-golden-600 text-white font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    + Add New
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex items-center mb-4">
            <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
            <h3 class="text-lg font-medium text-gray-900">Delete Activity</h3>
        </div>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this activity? This action cannot be undone.</p>
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
    // Make table sortable (desktop)
    const tbody = document.getElementById('activities-tbody');
    if (tbody) {
        new Sortable(tbody, {
            animation: 150,
            handle: '.fa-grip-vertical',
            onEnd: function(evt) {
                updateOrder();
            }
        });
    }

    // Make mobile list sortable
    const mobileList = document.getElementById('activities-mobile');
    if (mobileList) {
        new Sortable(mobileList, {
            animation: 150,
            handle: '.fa-grip-vertical',
            onEnd: function(evt) {
                updateOrderMobile();
            }
        });
    }

    function updateOrder() {
        const rows = document.querySelectorAll('#activities-tbody tr');
        const activities = [];

        rows.forEach((row, index) => {
            activities.push({
                id: row.dataset.id,
                sort_order: index + 1
            });
        });

        showLoading('global', 'Updating order...');

        fetch('{{ route("admin.activities.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ activities: activities })
        })
        .then(response => response.json())
        .then(data => {
            hideLoading('global');
            if (data.success) {
                // Update sort order display
                rows.forEach((row, index) => {
                    row.querySelector('td span').textContent = index + 1;
                });
            }
        })
        .catch(error => {
            hideLoading('global');
            console.error('Error:', error);
        });
    }

    function updateOrderMobile() {
        const items = document.querySelectorAll('#activities-mobile > div');
        const activities = [];

        items.forEach((item, index) => {
            activities.push({
                id: item.dataset.id,
                sort_order: index + 1
            });
        });

        showLoading('global', 'Updating order...');

        fetch('{{ route("admin.activities.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ activities: activities })
        })
        .then(response => response.json())
        .then(data => {
            hideLoading('global');
            if (data.success) {
                // Update sort order display in mobile view
                items.forEach((item, index) => {
                    const orderSpan = item.querySelector('.text-xs.text-gray-500');
                    if (orderSpan) {
                        orderSpan.textContent = `Order: ${index + 1}`;
                    }
                });
            }
        })
        .catch(error => {
            hideLoading('global');
            console.error('Error:', error);
        });
    }

    function deleteActivity(id) {
        document.getElementById('deleteForm').action = `/admin/activities/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    // Add loading to delete form
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.getElementById('deleteForm');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                showLoading('form', 'Deleting activity...');
            });
        }
    });
</script>
@endpush
