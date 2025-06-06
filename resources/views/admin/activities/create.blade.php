@extends('admin.layouts.app')

@section('title', 'Create Activity')
@section('page-title', 'Create New Activity')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-golden-600 hover:text-golden-800">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('admin.activities.index') }}" class="text-golden-600 hover:text-golden-800">Activities</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Create</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Activity Information</h2>
            <p class="text-sm text-gray-600 mt-1">Fill in the details for the new activity</p>
        </div>

        <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Activity Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors duration-200"
                       placeholder="Enter activity title">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number -->
            <div>
                <label for="number" class="block text-sm font-medium text-gray-700 mb-2">
                    Activity Number
                </label>
                <input type="text" 
                       id="number" 
                       name="number" 
                       value="{{ old('number') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors duration-200"
                       placeholder="e.g., 1/7">
                @error('number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Optional numbering for the activity (e.g., "1/7")</p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="6"
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors duration-200"
                          placeholder="Enter detailed description of the activity">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Use **text** for bold formatting</p>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Activity Image
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-golden-400 transition-colors duration-200">
                    <div class="space-y-1 text-center">
                        <div id="image-preview" class="hidden mb-4">
                            <img id="preview-img" src="" alt="Preview" class="mx-auto h-32 w-auto rounded-lg">
                        </div>
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-golden-600 hover:text-golden-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-golden-500">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                    Sort Order
                </label>
                <input type="number" 
                       id="sort_order" 
                       name="sort_order" 
                       value="{{ old('sort_order', 0) }}"
                       min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors duration-200"
                       placeholder="0">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
            </div>

            <!-- Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-golden-600 bg-gray-100 border-gray-300 rounded focus:ring-golden-500 focus:ring-2">
                    <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                </label>
                <p class="mt-1 text-sm text-gray-500">Inactive activities won't be displayed on the website</p>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.activities.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Activities
                </a>
                
                <div class="flex space-x-3">
                    <button type="button" 
                            onclick="resetForm()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Reset
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-golden-600 text-white font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Create Activity
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
        }
    }

    function resetForm() {
        if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
            document.querySelector('form').reset();
            document.getElementById('image-preview').classList.add('hidden');
        }
    }

    // Drag and drop functionality
    const dropZone = document.querySelector('.border-dashed');
    const fileInput = document.getElementById('image');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-golden-400', 'bg-golden-50');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-golden-400', 'bg-golden-50');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            fileInput.files = files;
            previewImage(fileInput);
        }
    }
</script>
@endpush
