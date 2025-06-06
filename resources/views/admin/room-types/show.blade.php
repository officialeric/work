@extends('admin.layouts.app')

@section('title', 'View Room Type')
@section('page-title', 'View Room Type')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-golden-600 hover:text-golden-800">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('admin.room-types.index') }}" class="text-golden-600 hover:text-golden-800">Room Types</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">{{ $roomType->name }}</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-golden-600 text-white px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-door-open mr-3"></i>
                    <h2 class="text-xl font-semibold">{{ $roomType->name }}</h2>
                </div>
                <div class="flex items-center space-x-2">
                    @if($roomType->is_active)
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Active</span>
                    @else
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">Inactive</span>
                    @endif
                    @if($roomType->is_featured)
                        <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-sm font-medium">Featured</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Price -->
                <div class="bg-golden-50 rounded-lg p-4">
                    <div class="text-golden-600 text-sm font-medium mb-1">Price</div>
                    <div class="text-golden-800 text-2xl font-bold">${{ number_format($roomType->price, 0) }}</div>
                    <div class="text-golden-600 text-sm">{{ $roomType->currency }}</div>
                </div>

                <!-- Tent Configuration -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="text-blue-600 text-sm font-medium mb-1">Tent Configuration</div>
                    <div class="text-blue-800 text-lg font-semibold">{{ $roomType->tent_configuration }}</div>
                    <div class="text-blue-600 text-sm">{{ $roomType->tent_type }}</div>
                </div>

                <!-- Occupancy -->
                <div class="bg-purple-50 rounded-lg p-4">
                    <div class="text-purple-600 text-sm font-medium mb-1">Maximum Occupancy</div>
                    <div class="text-purple-800 text-lg font-semibold">
                        @if($roomType->max_occupancy)
                            {{ $roomType->max_occupancy }} guests
                        @else
                            Not specified
                        @endif
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($roomType->description)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Description</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 leading-relaxed">{{ $roomType->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Features -->
            @if($roomType->features && count($roomType->features) > 0)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Features</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach($roomType->features as $feature)
                                <div class="flex items-center">
                                    <i class="fas fa-check text-golden-600 mr-2"></i>
                                    <span class="text-gray-700">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Images -->
            @if($roomType->main_image_url || $roomType->image_1_url || $roomType->image_2_url || $roomType->image_3_url)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Images</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @if($roomType->main_image_url)
                            <div class="relative">
                                <img src="{{ $roomType->main_image_url }}" alt="Main Image" class="w-full h-48 object-cover rounded-lg shadow-sm">
                                <span class="absolute top-2 left-2 bg-golden-600 text-white text-xs px-2 py-1 rounded">Main</span>
                            </div>
                        @endif
                        @foreach(['image_1_url', 'image_2_url', 'image_3_url'] as $index => $imageAttr)
                            @if($roomType->$imageAttr)
                                <div class="relative">
                                    <img src="{{ $roomType->$imageAttr }}" alt="Image {{ $index + 1 }}" class="w-full h-48 object-cover rounded-lg shadow-sm">
                                    <span class="absolute top-2 left-2 bg-gray-600 text-white text-xs px-2 py-1 rounded">{{ $index + 1 }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Metadata -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="text-sm font-medium text-gray-700 mb-1">Sort Order</div>
                        <div class="text-gray-900">{{ $roomType->sort_order }}</div>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-700 mb-1">Created</div>
                        <div class="text-gray-900">{{ $roomType->created_at->format('M d, Y \a\t g:i A') }}</div>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-700 mb-1">Last Updated</div>
                        <div class="text-gray-900">{{ $roomType->updated_at->format('M d, Y \a\t g:i A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.room-types.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Room Types
                </a>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.room-types.edit', $roomType) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Room Type
                    </a>
                    <form action="{{ route('admin.room-types.destroy', $roomType) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this room type?')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
