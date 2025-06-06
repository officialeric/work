@extends('admin.layouts.app')

@section('title', 'Room Types')
@section('page-title', 'Room Types')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-golden-600 hover:text-golden-800">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Room Types</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Room Types Management</h1>
            <p class="text-gray-600 mt-1">Manage your hotel room types, pricing, and tent configurations</p>
        </div>
        <a href="{{ route('admin.room-types.create') }}"
           class="inline-flex items-center px-4 py-2 bg-golden-600 text-white text-sm font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            + Add New Room Type
        </a>
    </div>

    <!-- Room Types Grid -->
    @if($roomTypes->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            @foreach($roomTypes as $roomType)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <!-- Card Header -->
                    <div class="bg-golden-600 text-white px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-door-open mr-3"></i>
                                <h3 class="text-lg font-semibold">{{ $roomType->name }}</h3>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="bg-white/20 text-white px-2 py-1 rounded text-sm font-medium">
                                    #{{ $roomType->sort_order }}
                                </span>
                                @if($roomType->is_active)
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-medium">Active</span>
                                @else
                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Inactive</span>
                                @endif
                                @if($roomType->is_featured)
                                    <span class="bg-amber-500 text-white px-2 py-1 rounded text-xs font-medium">Featured</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <!-- Price and Tent Info -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-golden-50 rounded-lg p-3">
                                <div class="text-golden-600 text-sm font-medium">Price</div>
                                <div class="text-golden-800 text-xl font-bold">${{ number_format($roomType->price, 0) }}</div>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3">
                                <div class="text-blue-600 text-sm font-medium">Tent Configuration</div>
                                <div class="text-blue-800 text-sm font-semibold">{{ $roomType->tent_configuration }}</div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($roomType->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $roomType->description }}</p>
                        @endif

                        <!-- Images -->
                        <div class="flex space-x-2 mb-4">
                            @if($roomType->main_image_url)
                                <img src="{{ $roomType->main_image_url }}" alt="Main" class="w-16 h-16 rounded-lg object-cover">
                            @endif
                            @foreach(['image_1_url', 'image_2_url', 'image_3_url'] as $imageAttr)
                                @if($roomType->$imageAttr)
                                    <img src="{{ $roomType->$imageAttr }}" alt="Image" class="w-16 h-16 rounded-lg object-cover">
                                @endif
                            @endforeach
                        </div>

                        <!-- Additional Info -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            @if($roomType->max_occupancy)
                                <span><i class="fas fa-users mr-1"></i>Max {{ $roomType->max_occupancy }} guests</span>
                            @endif
                            <span><i class="fas fa-calendar mr-1"></i>{{ $roomType->created_at->format('M d, Y') }}</span>
                        </div>

                        <!-- Features -->
                        @if($roomType->features && count($roomType->features) > 0)
                            <div class="mb-4">
                                <div class="text-sm font-medium text-gray-700 mb-2">Features:</div>
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($roomType->features, 0, 3) as $feature)
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ $feature }}</span>
                                    @endforeach
                                    @if(count($roomType->features) > 3)
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">+{{ count($roomType->features) - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.room-types.edit', $roomType) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <a href="{{ route('admin.room-types.show', $roomType) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-white text-xs font-medium rounded hover:bg-gray-700 transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>
                                    View
                                </a>
                            </div>
                            <form action="{{ route('admin.room-types.destroy', $roomType) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this room type?')"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition-colors duration-200">
                                    <i class="fas fa-trash mr-1"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 max-w-md mx-auto">
                <i class="fas fa-door-open text-gray-300 text-6xl mb-6"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-4">No Room Types Yet</h3>
                <p class="text-gray-600 mb-6">Start by creating your first room type with pricing and tent configuration.</p>
                <a href="{{ route('admin.room-types.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-golden-600 text-white font-medium rounded-lg hover:bg-golden-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    + Add New Room Type
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
