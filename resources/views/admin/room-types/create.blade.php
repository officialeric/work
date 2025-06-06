@extends('admin.layouts.app')

@section('title', 'Create Room Type')
@section('page-title', 'Create Room Type')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-golden-600 hover:text-golden-800">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('admin.room-types.index') }}" class="text-golden-600 hover:text-golden-800">Room Types</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Create</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-golden-600 text-white px-6 py-4">
            <div class="flex items-center">
                <i class="fas fa-door-open mr-3"></i>
                <h2 class="text-xl font-semibold">Create New Room Type</h2>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Room Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Room Type Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                           placeholder="e.g., DELUXE ROOM"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order *</label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                           min="0"
                           required>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Pricing Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           value="{{ old('price') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                           step="0.01"
                           min="0"
                           placeholder="800.00"
                           required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Currency -->
                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency *</label>
                    <select id="currency" 
                            name="currency" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                            required>
                        <option value="USD" {{ old('currency', 'USD') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                        <option value="EUR" {{ old('currency') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                        <option value="GBP" {{ old('currency') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                        <option value="TZS" {{ old('currency') === 'TZS' ? 'selected' : '' }}>TZS (TSh)</option>
                    </select>
                    @error('currency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tent Configuration -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tent Type -->
                <div>
                    <label for="tent_type" class="block text-sm font-medium text-gray-700 mb-2">Tent Type *</label>
                    <select id="tent_type" 
                            name="tent_type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                            required>
                        <option value="">Select tent type</option>
                        <option value="Big Tent" {{ old('tent_type') === 'Big Tent' ? 'selected' : '' }}>Big Tent</option>
                        <option value="Small Tents" {{ old('tent_type') === 'Small Tents' ? 'selected' : '' }}>Small Tents</option>
                    </select>
                    @error('tent_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tent Quantity -->
                <div>
                    <label for="tent_quantity" class="block text-sm font-medium text-gray-700 mb-2">Number of Tents *</label>
                    <input type="number" 
                           id="tent_quantity" 
                           name="tent_quantity" 
                           value="{{ old('tent_quantity', 1) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                           min="1"
                           required>
                    @error('tent_quantity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                          placeholder="Describe the room type, amenities, and features...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Additional Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Max Occupancy -->
                <div>
                    <label for="max_occupancy" class="block text-sm font-medium text-gray-700 mb-2">Maximum Occupancy</label>
                    <input type="number" 
                           id="max_occupancy" 
                           name="max_occupancy" 
                           value="{{ old('max_occupancy') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                           min="1"
                           placeholder="4">
                    @error('max_occupancy')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Features -->
                <div>
                    <label for="features" class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                    <textarea id="features" 
                              name="features" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500"
                              placeholder="Enter each feature on a new line&#10;Private bathroom&#10;Air conditioning&#10;Ocean view">{{ old('features') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Enter each feature on a new line</p>
                    @error('features')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Images -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Images</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Main Image -->
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                        <input type="file" 
                               id="main_image" 
                               name="main_image" 
                               accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500">
                        <p class="mt-1 text-xs text-gray-500">JPEG, PNG, JPG, GIF up to 2MB</p>
                        @error('main_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Additional Images -->
                    @for($i = 1; $i <= 3; $i++)
                        <div>
                            <label for="image_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">Additional Image {{ $i }}</label>
                            <input type="file" 
                                   id="image_{{ $i }}" 
                                   name="image_{{ $i }}" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-golden-500 focus:border-golden-500">
                            @error("image_$i")
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Status Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Active Status -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-golden-600 focus:ring-golden-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Active (visible on website)
                    </label>
                </div>

                <!-- Featured Status -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="is_featured" 
                           name="is_featured" 
                           value="1"
                           {{ old('is_featured') ? 'checked' : '' }}
                           class="h-4 w-4 text-golden-600 focus:ring-golden-500 border-gray-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                        Featured room type
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.room-types.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2 bg-golden-600 text-white text-sm font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Create Room Type
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
