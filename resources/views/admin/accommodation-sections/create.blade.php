@extends('admin.layouts.app')

@section('title', 'Create Accommodation Section')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create Accommodation Section</h1>
            <p class="text-gray-600 mt-1">Add a new accommodation section</p>
        </div>
        <a href="{{ route('admin.accommodation-sections.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Sections
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <i class="fas fa-plus mr-2 text-golden-600"></i>Accommodation Section Details
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.accommodation-sections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('title') border-red-500 @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order <span class="text-red-500">*</span></label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('sort_order') border-red-500 @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" required>
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center pt-6">
                        <label class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-golden-600 bg-gray-100 border-gray-300 rounded focus:ring-golden-500 focus:ring-2">
                            <span class="ml-2 text-sm text-gray-700">Active (visible on website)</span>
                        </label>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('description') border-red-500 @enderror" 
                              id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Images -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Main Image -->
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                        <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('main_image') border-red-500 @enderror" 
                               id="main_image" name="main_image" accept="image/*">
                        @error('main_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Recommended: 800x600px</p>
                    </div>

                    <!-- Image 1 -->
                    <div>
                        <label for="image_1" class="block text-sm font-medium text-gray-700 mb-2">Image 1</label>
                        <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('image_1') border-red-500 @enderror" 
                               id="image_1" name="image_1" accept="image/*">
                        @error('image_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Recommended: 400x300px</p>
                    </div>

                    <!-- Image 2 -->
                    <div>
                        <label for="image_2" class="block text-sm font-medium text-gray-700 mb-2">Image 2</label>
                        <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('image_2') border-red-500 @enderror" 
                               id="image_2" name="image_2" accept="image/*">
                        @error('image_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Recommended: 400x300px</p>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-3 pt-6">
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-golden-600 text-white rounded-lg hover:bg-golden-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Create Section
                    </button>
                    <a href="{{ route('admin.accommodation-sections.index') }}" class="inline-flex items-center px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
