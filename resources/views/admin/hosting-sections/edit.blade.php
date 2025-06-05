@extends('admin.layouts.app')

@section('title', 'Edit Hosting Section')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Hosting Section</h1>
            <p class="text-gray-600 mt-1">Update hosting section details</p>
        </div>
        <a href="{{ route('admin.hosting-sections.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Hosting Sections
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <i class="fas fa-edit mr-2 text-emerald-600"></i>Hosting Section Details
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.hosting-sections.update', $hostingSection) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                               id="title" name="title" value="{{ old('title', $hostingSection->title) }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('subtitle') border-red-500 @enderror"
                               id="subtitle" name="subtitle" value="{{ old('subtitle', $hostingSection->subtitle) }}">
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror"
                              id="description" name="description" rows="5" required>{{ old('description', $hostingSection->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video Settings -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="video_button_text" class="block text-sm font-medium text-gray-700 mb-2">Video Button Text <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('video_button_text') border-red-500 @enderror"
                               id="video_button_text" name="video_button_text" value="{{ old('video_button_text', $hostingSection->video_button_text) }}" required>
                        @error('video_button_text')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                        <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('video_url') border-red-500 @enderror"
                               id="video_url" name="video_url" value="{{ old('video_url', $hostingSection->video_url) }}"
                               placeholder="https://www.youtube.com/watch?v=...">
                        @error('video_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Optional: YouTube, Vimeo, or direct video URL</p>
                    </div>
                </div>

                <!-- Current Background Image -->
                @if($hostingSection->background_image_url)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Background Image</label>
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden max-w-sm">
                            <img src="{{ $hostingSection->background_image_url }}" class="w-full h-48 object-cover">
                            <div class="p-3">
                                <p class="text-sm text-gray-500">Current background image</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- New Background Image -->
                <div>
                    <label for="background_image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $hostingSection->background_image_url ? 'Replace Background Image' : 'Background Image' }}
                    </label>
                    <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('background_image') border-red-500 @enderror"
                           id="background_image" name="background_image" accept="image/*">
                    @error('background_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Recommended: 1200x800px. This will be used as a subtle background for the content card.</p>
                </div>

                <!-- Settings -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order <span class="text-red-500">*</span></label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('sort_order') border-red-500 @enderror"
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $hostingSection->sort_order) }}" min="0" required>
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $hostingSection->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500 focus:ring-2">
                            <span class="ml-2 text-sm text-gray-700">Active (visible on website)</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-3 pt-6">
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Update Hosting Section
                    </button>
                    <a href="{{ route('admin.hosting-sections.index') }}" class="inline-flex items-center px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
