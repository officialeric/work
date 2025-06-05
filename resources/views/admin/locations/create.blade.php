@extends('admin.layouts.app')

@section('title', 'Create Location')
@section('page-title', 'Create Location')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create New Location</h1>
            <p class="text-gray-600 mt-1">Add a new location section to the website</p>
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
                <i class="fas fa-plus mr-2 text-emerald-600"></i>Location Details
            </h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.locations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information Section -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-info-circle me-2"></i>Basic Information
                    </h5>
                    <div class="row">
                        <!-- Title -->
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required
                                   placeholder="e.g., Location">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subtitle -->
                        <div class="col-md-6 mb-3">
                            <label for="subtitle" class="form-label fw-bold">Subtitle</label>
                            <input type="text" class="form-control form-control-lg @error('subtitle') is-invalid @enderror"
                                   id="subtitle" name="subtitle" value="{{ old('subtitle') }}"
                                   placeholder="e.g., A breathtaking setting">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-file-alt me-2"></i>Content
                    </h5>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Main Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4" required
                                  placeholder="Enter the main description for this location...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">This will be the primary description displayed on the website.</small>
                    </div>

                    <!-- Additional Description -->
                    <div class="mb-3">
                        <label for="additional_description" class="form-label fw-bold">Additional Description</label>
                        <textarea class="form-control @error('additional_description') is-invalid @enderror"
                                  id="additional_description" name="additional_description" rows="3"
                                  placeholder="Enter additional details (optional)...">{{ old('additional_description') }}</textarea>
                        @error('additional_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Optional: Additional content to provide more details.</small>
                    </div>
                </div>

                <!-- Images Section -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-images me-2"></i>Images
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card border-2 border-dashed border-primary">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-image fa-2x text-primary mb-2"></i>
                                    <h6 class="card-title">Main Image</h6>
                                    <label for="image_1" class="form-label fw-bold">Image 1</label>
                                    <input type="file" class="form-control @error('image_1') is-invalid @enderror"
                                           id="image_1" name="image_1" accept="image/*">
                                    @error('image_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Recommended: 600x800px</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-2 border-dashed border-success">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-image fa-2x text-success mb-2"></i>
                                    <h6 class="card-title">Secondary Image</h6>
                                    <label for="image_2" class="form-label fw-bold">Image 2</label>
                                    <input type="file" class="form-control @error('image_2') is-invalid @enderror"
                                           id="image_2" name="image_2" accept="image/*">
                                    @error('image_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Recommended: 600x400px</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-2 border-dashed border-warning">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-image fa-2x text-warning mb-2"></i>
                                    <h6 class="card-title">Accent Image</h6>
                                    <label for="image_3" class="form-label fw-bold">Image 3</label>
                                    <input type="file" class="form-control @error('image_3') is-invalid @enderror"
                                           id="image_3" name="image_3" accept="image/*">
                                    @error('image_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Recommended: 600x300px</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Settings Section -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-mouse-pointer me-2"></i>Button Settings
                    </h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="button_text" class="form-label fw-bold">Button Text <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                                       id="button_text" name="button_text" value="{{ old('button_text', 'View Gallery') }}" required
                                       placeholder="e.g., View Gallery">
                            </div>
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="button_link" class="form-label fw-bold">Button Link <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                <input type="text" class="form-control @error('button_link') is-invalid @enderror"
                                       id="button_link" name="button_link" value="{{ old('button_link', '#gallery') }}" required
                                       placeholder="e.g., #gallery">
                            </div>
                            @error('button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Use # for anchor links (e.g., #gallery) or full URLs</small>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-cogs me-2"></i>Settings
                    </h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label fw-bold">Sort Order <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" min="0" required>
                            </div>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Visibility</label>
                            <div class="form-check form-switch mt-2">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-eye me-1"></i>Active (visible on website)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex gap-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Create Location
                    </button>
                    <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
