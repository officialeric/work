@extends('admin.layouts.app')

@section('title', 'Edit Commitment')
@section('page-title', 'Edit Commitment')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-golden-600 hover:text-golden-800">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('admin.commitments.index') }}" class="text-golden-600 hover:text-golden-800">Commitments</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Edit</span>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Edit Commitment: {{ $commitment->title }}</h2>
            <p class="text-sm text-gray-600 mt-1">Update the commitment information</p>
        </div>

        <form action="{{ route('admin.commitments.update', $commitment) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Commitment Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $commitment->title) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors duration-200"
                       placeholder="Enter commitment title">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Describe your eco-tourism practice or sustainability commitment</p>
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                    Icon <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center space-x-4">
                    <input type="text" 
                           id="icon" 
                           name="icon" 
                           value="{{ old('icon', $commitment->icon) }}"
                           required
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors duration-200"
                           placeholder="fas fa-solar-panel"
                           oninput="updateIconPreview()">
                    <div id="icon-preview" class="w-12 h-12 bg-golden-100 rounded-lg flex items-center justify-center">
                        <i class="{{ old('icon', $commitment->icon) }} text-golden-600 text-xl"></i>
                    </div>
                </div>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">FontAwesome icon class (e.g., "fas fa-solar-panel")</p>
                
                <!-- Common Eco Icons -->
                <div class="mt-3">
                    <p class="text-sm font-medium text-gray-700 mb-2">Common Eco Icons:</p>
                    <div class="grid grid-cols-4 gap-2">
                        <button type="button" onclick="selectIcon('fas fa-solar-panel')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-solar-panel' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-solar-panel text-gray-600"></i>
                            <span class="block text-xs mt-1">Solar</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-tint')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-tint' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-tint text-gray-600"></i>
                            <span class="block text-xs mt-1">Water</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-leaf')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-leaf' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-leaf text-gray-600"></i>
                            <span class="block text-xs mt-1">Eco</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-recycle')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-recycle' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-recycle text-gray-600"></i>
                            <span class="block text-xs mt-1">Recycle</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-hammer')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-hammer' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-hammer text-gray-600"></i>
                            <span class="block text-xs mt-1">Build</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-car-battery')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-car-battery' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-car-battery text-gray-600"></i>
                            <span class="block text-xs mt-1">Electric</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-filter')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-filter' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-filter text-gray-600"></i>
                            <span class="block text-xs mt-1">Filter</span>
                        </button>
                        <button type="button" onclick="selectIcon('fas fa-tree')" class="icon-btn p-2 border border-gray-300 rounded-lg hover:bg-golden-50 hover:border-golden-300 transition-colors duration-200 {{ old('icon', $commitment->icon) === 'fas fa-tree' ? 'bg-golden-100 border-golden-500' : '' }}">
                            <i class="fas fa-tree text-gray-600"></i>
                            <span class="block text-xs mt-1">Nature</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                    Sort Order
                </label>
                <input type="number" 
                       id="sort_order" 
                       name="sort_order" 
                       value="{{ old('sort_order', $commitment->sort_order) }}"
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
                           {{ old('is_active', $commitment->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-golden-600 bg-gray-100 border-gray-300 rounded focus:ring-golden-500 focus:ring-2">
                    <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                </label>
                <p class="mt-1 text-sm text-gray-500">Inactive commitments won't be displayed on the website</p>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.commitments.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Commitments
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
                        Update Commitment
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateIconPreview() {
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        const iconClass = iconInput.value.trim();
        
        if (iconClass) {
            iconPreview.innerHTML = `<i class="${iconClass} text-golden-600 text-xl"></i>`;
        } else {
            iconPreview.innerHTML = '<i class="fas fa-question text-golden-600 text-xl"></i>';
        }
    }

    function selectIcon(iconClass) {
        document.getElementById('icon').value = iconClass;
        updateIconPreview();
        
        // Remove active state from all buttons
        document.querySelectorAll('.icon-btn').forEach(btn => {
            btn.classList.remove('bg-golden-100', 'border-golden-500');
        });
        
        // Add active state to clicked button
        event.target.closest('.icon-btn').classList.add('bg-golden-100', 'border-golden-500');
    }

    function resetForm() {
        if (confirm('Are you sure you want to reset the form? All changes will be lost.')) {
            location.reload();
        }
    }

    // Initialize icon preview
    document.addEventListener('DOMContentLoaded', function() {
        updateIconPreview();
    });
</script>
@endpush
