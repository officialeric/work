@extends('admin.layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800">Dashboard</a>
    <span class="mx-2">/</span>
    <a href="{{ route('admin.profile.show') }}" class="text-emerald-600 hover:text-emerald-800">Profile</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Edit</span>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Edit Profile Information</h2>
            <p class="text-sm text-gray-600 mt-1">Update your account details</p>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Profile Avatar -->
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-emerald-600 text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $admin->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $admin->email }}</p>
                    <p class="text-xs text-gray-500 mt-1">Member since {{ $admin->created_at->format('M Y') }}</p>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $admin->name) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                       placeholder="Enter your full name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $admin->email) }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                       placeholder="Enter your email address">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                    {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
                </div>
                <p class="mt-1 text-sm text-gray-500">Role cannot be changed from this interface</p>
            </div>

            <!-- Account Status (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                <div class="flex items-center">
                    @if($admin->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-2"></i>
                            Inactive
                        </span>
                    @endif
                </div>
            </div>

            <!-- Account Information -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Account Information</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="break-words">
                        <span class="text-gray-600">Created:</span>
                        <span class="text-gray-900 ml-2 block sm:inline">{{ $admin->created_at->format('M j, Y g:i A') }}</span>
                    </div>
                    <div class="break-words">
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="text-gray-900 ml-2 block sm:inline">{{ $admin->updated_at->format('M j, Y g:i A') }}</span>
                    </div>
                    <div class="break-words">
                        <span class="text-gray-600">Last Login:</span>
                        <span class="text-gray-900 ml-2 block sm:inline">
                            {{ $admin->last_login_at ? $admin->last_login_at->format('M j, Y g:i A') : 'Never' }}
                        </span>
                    </div>
                    <div class="break-words">
                        <span class="text-gray-600">Total Actions:</span>
                        <span class="text-gray-900 ml-2 block sm:inline">{{ $admin->activityLogs()->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.profile.show') }}"
                   class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm sm:text-base">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back
                </a>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button"
                            onclick="resetForm()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm sm:text-base">
                        Reset
                    </button>
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200 text-sm sm:text-base">
                        <i class="fas fa-save mr-2"></i>
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function resetForm() {
        if (confirm('Are you sure you want to reset the form? All changes will be lost.')) {
            location.reload();
        }
    }
</script>
@endpush
