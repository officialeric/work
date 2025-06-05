@extends('admin.layouts.app')

@section('title', 'Locations Management')
@section('page-title', 'Locations Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Locations Management</h1>
            <p class="text-gray-600 mt-1">Manage location sections for the website</p>
        </div>
        <a href="{{ route('admin.locations.create') }}"
           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add New Location
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Locations Grid -->
    @if($locations->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($locations as $location)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <!-- Card Header -->
                    <div class="bg-emerald-600 text-white px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3"></i>
                                <h3 class="text-lg font-semibold">{{ $location->title }}</h3>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="bg-white/20 text-white px-2 py-1 rounded text-sm font-medium">
                                    #{{ $location->sort_order }}
                                </span>
                                @if($location->is_active)
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-sm font-medium">
                                        <i class="fas fa-eye mr-1"></i>Active
                                    </span>
                                @else
                                    <span class="bg-gray-500 text-white px-2 py-1 rounded text-sm font-medium">
                                        <i class="fas fa-eye-slash mr-1"></i>Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Images Section -->
                    @if($location->image_1_url || $location->image_2_url || $location->image_3_url)
                        <div class="grid grid-cols-2 gap-0">
                            @if($location->image_1_url)
                                <div class="col-span-1">
                                    <img src="{{ $location->image_1_url }}" alt="Image 1"
                                         class="w-full h-32 object-cover">
                                </div>
                            @endif
                            <div class="grid grid-rows-2 gap-0">
                                @if($location->image_2_url)
                                    <div>
                                        <img src="{{ $location->image_2_url }}" alt="Image 2"
                                             class="w-full h-16 object-cover">
                                    </div>
                                @endif
                                @if($location->image_3_url)
                                    <div>
                                        <img src="{{ $location->image_3_url }}" alt="Image 3"
                                             class="w-full h-16 object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-50">
                            <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500">No images uploaded</p>
                        </div>
                    @endif

                    <!-- Content Section -->
                    <div class="p-6">
                        @if($location->subtitle)
                            <h4 class="text-emerald-600 font-medium mb-3">{{ $location->subtitle }}</h4>
                        @endif

                        <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                            {{ Str::limit($location->description, 120) }}
                        </p>

                        @if($location->additional_description)
                            <p class="text-gray-500 mb-4 text-xs leading-relaxed">
                                {{ Str::limit($location->additional_description, 80) }}
                            </p>
                        @endif

                        <!-- Button Info -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-link text-emerald-600 mr-2"></i>
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">{{ $location->button_text }}</span>
                            </div>
                            <span class="text-gray-400 text-xs truncate max-w-32">{{ $location->button_link }}</span>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-clock mr-1"></i>
                                Updated {{ $location->updated_at->diffForHumans() }}
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.locations.edit', $location) }}"
                                   class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-sm rounded hover:bg-emerald-700 transition-colors duration-200"
                                   title="Edit Location">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <button type="button"
                                        onclick="confirmDelete({{ $location->id }}, '{{ $location->title }}')"
                                        class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors duration-200"
                                        title="Delete Location">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="mb-6">
                <i class="fas fa-map-marker-alt text-gray-400 text-6xl mb-4"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">No locations found</h3>
            <p class="text-gray-600 mb-6">Create your first location section to showcase your beautiful destinations.</p>
            <a href="{{ route('admin.locations.create') }}"
               class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Create Your First Location
            </a>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Confirm Delete</h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mb-4">
                <p class="text-gray-600">Are you sure you want to delete the location "<span id="deleteItemName" class="font-medium"></span>"?</p>
                <p class="text-red-600 text-sm mt-2">This action cannot be undone.</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition-colors duration-200">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors duration-200">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/locations/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endsection
