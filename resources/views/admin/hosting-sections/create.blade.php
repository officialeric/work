@extends('admin.layouts.app')

@section('title', 'Create Hosting Section')
@section('page-title', 'Create Hosting Section')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create New Hosting Section</h1>
            <p class="text-gray-600 mt-1">Add a new hosting section to the website</p>
        </div>
        <a href="{{ route('admin.hosting-sections.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Hosting Sections
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-plus mr-2 text-emerald-600"></i>Hosting Section Details
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.hosting-sections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Basic Information Section -->
                <div>
                    <h4 class="text-lg font-medium text-emerald-600 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Basic Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   required
                                   placeholder="e.g., Hosting"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('title') border-red-500 @enderror">
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
                                   value="{{ old('subtitle') }}"
                                   placeholder="e.g., Escape & Serenity"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('subtitle') border-red-500 @enderror">
                            @error('subtitle')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div>
                    <h4 class="text-lg font-medium text-emerald-600 mb-4">
                        <i class="fas fa-file-alt mr-2"></i>Content
                    </h4>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description"
                                  name="description"
                                  rows="5"
                                  required
                                  placeholder="Enter the hosting section description..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">This will be the main content displayed in the hosting section.</p>
                    </div>
                </div>

                <!-- Video Settings -->
                <div>
                    <h4 class="text-lg font-medium text-emerald-600 mb-4">
                        <i class="fas fa-play-circle mr-2"></i>Video Settings
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="video_button_text" class="block text-sm font-medium text-gray-700 mb-2">
                                Video Button Text <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="video_button_text"
                                   name="video_button_text"
                                   value="{{ old('video_button_text', 'Watch Experience Video') }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('video_button_text') border-red-500 @enderror">
                            @error('video_button_text')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                            <input type="url"
                                   id="video_url"
                                   name="video_url"
                                   value="{{ old('video_url') }}"
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('video_url') border-red-500 @enderror">
                            @error('video_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Optional: YouTube, Vimeo, or direct video URL</p>
                        </div>
                    </div>
                </div>

                <!-- Background Image -->
                <div>
                    <h4 class="text-lg font-medium text-emerald-600 mb-4">
                        <i class="fas fa-image mr-2"></i>Background Image
                    </h4>
                    <div>
                        <label for="background_image" class="block text-sm font-medium text-gray-700 mb-2">Background Image</label>
                        <input type="file"
                               id="background_image"
                               name="background_image"
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200 @error('background_image') border-red-500 @enderror">
                        @error('background_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Recommended: 1200x800px. This will be used as a subtle background for the content card.</p>
                    </div>
                </div>

                <!-- Settings -->
                <div>
                    <h4 class="text-lg font-medium text-emerald-600 mb-4">
                        <i class="fas fa-cog mr-2"></i>Settings
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                Sort Order <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   id="sort_order"
                                   name="sort_order"
                                   value="{{ old('sort_order', 1) }}"
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
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500 focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Active (visible on website)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex space-x-3 pt-6">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Create Hosting Section
                    </button>
                    <a href="{{ route('admin.hosting-sections.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
