@extends('admin.layouts.app')

@section('title', 'Hosting Sections Management')
@section('page-title', 'Hosting Sections Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Hosting Sections Management</h1>
            <p class="text-gray-600 mt-1">Manage hosting sections for the website</p>
        </div>
        <a href="{{ route('admin.hosting-sections.create') }}"
           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add New Hosting Section
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

    <!-- Hosting Sections Grid -->
    @if($hostingSections->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($hostingSections as $section)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <!-- Card Header -->
                    <div class="bg-emerald-600 text-white px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-home mr-3"></i>
                                <h3 class="text-lg font-semibold">{{ $section->title }}</h3>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="bg-white/20 text-white px-2 py-1 rounded text-sm font-medium">
                                    #{{ $section->sort_order }}
                                </span>
                                @if($section->is_active)
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

                    <!-- Background Image Section -->
                    @if($section->background_image_url)
                        <div class="relative">
                            <img src="{{ $section->background_image_url }}" alt="Background"
                                 class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-25 flex items-center justify-center">
                                <span class="bg-white/90 text-gray-800 px-3 py-2 rounded text-sm font-medium">
                                    <i class="fas fa-image mr-1"></i>Background Image
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-50">
                            <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500">No background image</p>
                        </div>
                    @endif

                    <!-- Content Section -->
                    <div class="p-6">
                        @if($section->subtitle)
                            <h4 class="text-emerald-600 font-medium mb-3">{{ $section->subtitle }}</h4>
                        @endif

                        <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                            {{ Str::limit($section->description, 150) }}
                        </p>

                        <!-- Video Button Info -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-play-circle text-emerald-600 mr-2"></i>
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">{{ $section->video_button_text }}</span>
                            </div>
                            @if($section->video_url)
                                <div class="flex items-center">
                                    <i class="fas fa-external-link-alt text-emerald-600 mr-1"></i>
                                    <span class="text-emerald-600 text-sm font-medium">Has Video URL</span>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">No video URL</span>
                            @endif
                        </div>

                        @if($section->video_url)
                            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                <p class="text-gray-500 text-xs mb-1">Video URL:</p>
                                <a href="{{ $section->video_url }}" target="_blank"
                                   class="text-emerald-600 hover:text-emerald-700 text-sm truncate block">
                                    {{ Str::limit($section->video_url, 50) }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-clock mr-1"></i>
                                Updated {{ $section->updated_at->diffForHumans() }}
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.hosting-sections.edit', $section) }}"
                                   class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-sm rounded hover:bg-emerald-700 transition-colors duration-200"
                                   title="Edit Hosting Section">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <button type="button"
                                        onclick="confirmDelete({{ $section->id }}, '{{ $section->title }}')"
                                        class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors duration-200"
                                        title="Delete Hosting Section">
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
                <i class="fas fa-home text-gray-400 text-6xl mb-4"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">No hosting sections found</h3>
            <p class="text-gray-600 mb-6">Create your first hosting section to showcase your accommodation and services.</p>
            <a href="{{ route('admin.hosting-sections.create') }}"
               class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Create Your First Hosting Section
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
                <p class="text-gray-600">Are you sure you want to delete the hosting section "<span id="deleteItemName" class="font-medium"></span>"?</p>
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
    document.getElementById('deleteForm').action = `/admin/hosting-sections/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endsection
