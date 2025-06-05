@extends('admin.layouts.app')

@section('title', 'Edit Hosting Section')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Hosting Section</h1>
            <p class="text-muted">Update hosting section details</p>
        </div>
        <a href="{{ route('admin.hosting-sections.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Hosting Sections
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-edit me-2"></i>Hosting Section Details
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hosting-sections.update', $hostingSection) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Title -->
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $hostingSection->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="col-md-6 mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                               id="subtitle" name="subtitle" value="{{ old('subtitle', $hostingSection->subtitle) }}">
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5" required>{{ old('description', $hostingSection->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Video Settings -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="video_button_text" class="form-label">Video Button Text <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('video_button_text') is-invalid @enderror" 
                               id="video_button_text" name="video_button_text" value="{{ old('video_button_text', $hostingSection->video_button_text) }}" required>
                        @error('video_button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="video_url" class="form-label">Video URL</label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                               id="video_url" name="video_url" value="{{ old('video_url', $hostingSection->video_url) }}" 
                               placeholder="https://www.youtube.com/watch?v=...">
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Optional: YouTube, Vimeo, or direct video URL</small>
                    </div>
                </div>

                <!-- Current Background Image -->
                @if($hostingSection->background_image_url)
                    <div class="mb-3">
                        <label class="form-label">Current Background Image</label>
                        <div class="card" style="max-width: 300px;">
                            <img src="{{ $hostingSection->background_image_url }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body p-2">
                                <small class="text-muted">Current background image</small>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- New Background Image -->
                <div class="mb-3">
                    <label for="background_image" class="form-label">
                        {{ $hostingSection->background_image_url ? 'Replace Background Image' : 'Background Image' }}
                    </label>
                    <input type="file" class="form-control @error('background_image') is-invalid @enderror" 
                           id="background_image" name="background_image" accept="image/*">
                    @error('background_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Recommended: 1200x800px. This will be used as a subtle background for the content card.</small>
                </div>

                <!-- Settings -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $hostingSection->sort_order) }}" min="0" required>
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-center pt-6">
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
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Hosting Section
                    </button>
                    <a href="{{ route('admin.hosting-sections.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
