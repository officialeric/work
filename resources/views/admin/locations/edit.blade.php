@extends('admin.layouts.app')

@section('title', 'Edit Location')
@section('page-title', 'Edit Location')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Location</h1>
            <p class="text-gray-600 mt-1">Update location section details</p>
        </div>
        <a href="{{ route('admin.locations.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Locations
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-edit mr-2 text-emerald-600"></i>Location Details
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.locations.update', $location) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $location->title) }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                        <input type="text"
                               id="subtitle"
                               name="subtitle"
                               value="{{ old('subtitle', $location->subtitle) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('subtitle') border-red-500 @enderror">
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('description') border-red-500 @enderror">{{ old('description', $location->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Description -->
                <div>
                    <label for="additional_description" class="block text-sm font-medium text-gray-700 mb-2">Additional Description</label>
                    <textarea id="additional_description"
                              name="additional_description"
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('additional_description') border-red-500 @enderror">{{ old('additional_description', $location->additional_description) }}</textarea>
                    @error('additional_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Images -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Current Images</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if($location->image_1_url)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <img src="{{ $location->image_1_url }}"
                                     alt="Image 1"
                                     class="w-full h-32 object-cover rounded-lg shadow-sm">
                                <p class="text-sm text-gray-600 mt-2 text-center">Image 1</p>
                            </div>
                        @endif
                        @if($location->image_2_url)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <img src="{{ $location->image_2_url }}"
                                     alt="Image 2"
                                     class="w-full h-32 object-cover rounded-lg shadow-sm">
                                <p class="text-sm text-gray-600 mt-2 text-center">Image 2</p>
                            </div>
                        @endif
                        @if($location->image_3_url)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <img src="{{ $location->image_3_url }}"
                                     alt="Image 3"
                                     class="w-full h-32 object-cover rounded-lg shadow-sm">
                                <p class="text-sm text-gray-600 mt-2 text-center">Image 3</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- New Images -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="image_1" class="block text-sm font-medium text-gray-700 mb-2">Replace Image 1</label>
                        <input type="file"
                               id="image_1"
                               name="image_1"
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('image_1') border-red-500 @enderror">
                        @error('image_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Recommended: 600x800px</p>
                    </div>

                    <div>
                        <label for="image_2" class="block text-sm font-medium text-gray-700 mb-2">Replace Image 2</label>
                        <input type="file"
                               id="image_2"
                               name="image_2"
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('image_2') border-red-500 @enderror">
                        @error('image_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Recommended: 600x400px</p>
                    </div>

                    <div>
                        <label for="image_3" class="block text-sm font-medium text-gray-700 mb-2">Replace Image 3</label>
                        <input type="file"
                               id="image_3"
                               name="image_3"
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('image_3') border-red-500 @enderror">
                        @error('image_3')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Recommended: 600x300px</p>
                    </div>
                </div>

                <!-- Button Settings -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">
                            Button Text <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="button_text"
                               name="button_text"
                               value="{{ old('button_text', $location->button_text) }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('button_text') border-red-500 @enderror">
                        @error('button_text')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">
                            Button Link <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="button_link"
                               name="button_link"
                               value="{{ old('button_link', $location->button_link) }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('button_link') border-red-500 @enderror">
                        @error('button_link')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Use # for anchor links (e.g., #gallery) or full URLs</p>
                    </div>
                </div>

                <!-- Settings -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            Sort Order <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               id="sort_order"
                               name="sort_order"
                               value="{{ old('sort_order', $location->sort_order) }}"
                               min="0"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('sort_order') border-red-500 @enderror">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $location->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500 focus:ring-2">
                            <span class="ml-2 text-sm text-gray-700">Active (visible on website)</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex space-x-3 pt-6">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Update Location
                    </button>
                    <a href="{{ route('admin.locations.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
