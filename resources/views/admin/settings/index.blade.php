@extends('admin.layouts.app')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}" class="text-emerald-600 hover:text-emerald-800">Dashboard</a>
    <span class="mx-2">/</span>
    <span class="text-gray-600">Settings</span>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-between sm:items-center">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Website Settings</h1>
            <p class="text-gray-600 mt-1 text-sm sm:text-base">Configure your website's general settings, SEO, and content</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <button onclick="resetSettings()"
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm sm:text-base">
                <i class="fas fa-undo mr-2"></i>
                Reset to Defaults
            </button>
            <a href="{{ route('saadani.index') }}"
               target="_blank"
               class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200 text-sm sm:text-base">
                <i class="fas fa-external-link-alt mr-2"></i>
                Preview Website
            </a>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Settings Tabs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4 sm:space-x-8 px-4 sm:px-6 overflow-auto" aria-label="Tabs">
                    <button type="button" onclick="showTab('general')" class="tab-button active py-4 px-1 border-b-2 border-emerald-500 font-medium text-sm text-emerald-600">
                        <i class="fas fa-cog mr-2"></i>General
                    </button>
                    <button type="button" onclick="showTab('hero')" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <i class="fas fa-image mr-2"></i>Hero Section
                    </button>
                    <button type="button" onclick="showTab('contact')" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <i class="fas fa-address-book mr-2"></i>Contact
                    </button>
                    <button type="button" onclick="showTab('seo')" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <i class="fas fa-search mr-2"></i>SEO
                    </button>
                    <button type="button" onclick="showTab('social')" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <i class="fas fa-share-alt mr-2"></i>Social Media
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-4 sm:p-6">
                <!-- General Settings Tab -->
                <div id="general-tab" class="tab-content space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">General Settings</h3>
                    
                    @if(isset($settings['general']))
                        @foreach($settings['general'] as $setting)
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ $setting->label }}
                                        @if(in_array($setting->key, ['site_name', 'site_description']))
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    @if($setting->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $setting->description }}</p>
                                    @endif
                                </div>
                                
                                <div class="lg:col-span-2">
                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" 
                                                  rows="4"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                                  placeholder="{{ $setting->label }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @elseif($setting->type === 'image')
                                        <div class="space-y-3">
                                            @if($setting->value)
                                                <div class="flex items-center space-x-4">
                                                    <img src="{{ Storage::url($setting->value) }}" 
                                                         alt="{{ $setting->label }}" 
                                                         class="h-16 w-auto rounded-lg border border-gray-200">
                                                    <div>
                                                        <p class="text-sm text-gray-600">Current {{ strtolower($setting->label) }}</p>
                                                        <p class="text-xs text-gray-500">{{ basename($setting->value) }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="file" 
                                                   name="{{ $setting->key }}" 
                                                   accept="image/*"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                                        </div>
                                    @else
                                        <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}" 
                                               name="{{ $setting->key }}" 
                                               value="{{ old($setting->key, $setting->value) }}"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                               placeholder="{{ $setting->label }}">
                                    @endif
                                    @error($setting->key)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Hero Section Tab -->
                <div id="hero-tab" class="tab-content hidden space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hero Section Settings</h3>
                    
                    @if(isset($settings['hero']))
                        @foreach($settings['hero'] as $setting)
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ $setting->label }}
                                        @if(in_array($setting->key, ['hero_title']))
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    @if($setting->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $setting->description }}</p>
                                    @endif
                                </div>
                                
                                <div class="lg:col-span-2">
                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" 
                                                  rows="3"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                                  placeholder="{{ $setting->label }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @elseif($setting->type === 'image')
                                        <div class="space-y-3">
                                            @if($setting->value)
                                                <div class="flex items-center space-x-4">
                                                    <img src="{{ Storage::url($setting->value) }}" 
                                                         alt="{{ $setting->label }}" 
                                                         class="h-20 w-auto rounded-lg border border-gray-200">
                                                    <div>
                                                        <p class="text-sm text-gray-600">Current {{ strtolower($setting->label) }}</p>
                                                        <p class="text-xs text-gray-500">{{ basename($setting->value) }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="file" 
                                                   name="{{ $setting->key }}" 
                                                   accept="image/*"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                                        </div>
                                    @else
                                        <input type="text" 
                                               name="{{ $setting->key }}" 
                                               value="{{ old($setting->key, $setting->value) }}"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                               placeholder="{{ $setting->label }}">
                                    @endif
                                    @error($setting->key)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Contact Tab -->
                <div id="contact-tab" class="tab-content hidden space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    
                    @if(isset($settings['contact']))
                        @foreach($settings['contact'] as $setting)
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ $setting->label }}
                                        @if(in_array($setting->key, ['contact_email']))
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    @if($setting->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $setting->description }}</p>
                                    @endif
                                </div>
                                
                                <div class="lg:col-span-2">
                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" 
                                                  rows="3"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                                  placeholder="{{ $setting->label }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @else
                                        <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}" 
                                               name="{{ $setting->key }}" 
                                               value="{{ old($setting->key, $setting->value) }}"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                               placeholder="{{ $setting->label }}">
                                    @endif
                                    @error($setting->key)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- SEO Tab -->
                <div id="seo-tab" class="tab-content hidden space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
                    
                    @if(isset($settings['seo']))
                        @foreach($settings['seo'] as $setting)
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $setting->label }}</label>
                                    @if($setting->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $setting->description }}</p>
                                    @endif
                                </div>
                                
                                <div class="lg:col-span-2">
                                    <textarea name="{{ $setting->key }}" 
                                              rows="{{ $setting->key === 'google_analytics' ? '6' : '4' }}"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                              placeholder="{{ $setting->label }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @error($setting->key)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Social Media Tab -->
                <div id="social-tab" class="tab-content hidden space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Social Media Links</h3>
                    
                    @if(isset($settings['social']))
                        @foreach($settings['social'] as $setting)
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $setting->label }}</label>
                                    @if($setting->description)
                                        <p class="text-sm text-gray-500 mt-1">{{ $setting->description }}</p>
                                    @endif
                                </div>
                                
                                <div class="lg:col-span-2">
                                    <input type="url" 
                                           name="{{ $setting->key }}" 
                                           value="{{ old($setting->key, $setting->value) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                                           placeholder="{{ $setting->label }}">
                                    @error($setting->key)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="space-y-4 sm:space-y-0 sm:flex sm:items-center sm:justify-between">
            <div class="text-sm text-gray-500 text-center sm:text-left">
                <i class="fas fa-info-circle mr-1"></i>
                Changes will be applied immediately to your website
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button"
                        onclick="location.reload()"
                        class="px-6 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm sm:text-base">
                    Cancel
                </button>
                <button type="submit"
                        id="save-settings-btn"
                        class="inline-flex items-center justify-center px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition-colors duration-200 text-sm sm:text-base">
                    <i class="fas fa-save mr-2"></i>
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active class from all tab buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active', 'border-emerald-500', 'text-emerald-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Show selected tab content
        document.getElementById(tabName + '-tab').classList.remove('hidden');
        
        // Add active class to clicked tab button
        event.target.classList.add('active', 'border-emerald-500', 'text-emerald-600');
        event.target.classList.remove('border-transparent', 'text-gray-500');
    }

    function resetSettings() {
        if (confirm('Are you sure you want to reset all settings to their default values? This action cannot be undone.')) {
            showLoading('form', 'Resetting settings...');

            fetch('{{ route("admin.settings.reset") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading('form');
                if (data.success) {
                    location.reload();
                } else {
                    alert('Reset failed: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                hideLoading('form');
                console.error('Error:', error);
                alert('An error occurred while resetting settings.');
            });
        }
    }

    // Form submission with loading
    document.addEventListener('DOMContentLoaded', function() {
        const settingsForm = document.querySelector('form');
        const saveBtn = document.getElementById('save-settings-btn');

        if (settingsForm && saveBtn) {
            settingsForm.addEventListener('submit', function(e) {
                // Show loading state
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<i class="fas fa-spinner animate-spin mr-2"></i>Saving...';
                showLoading('form', 'Saving settings...');

                // The form will submit normally, but we show loading state
            });
        }
    });
</script>
@endpush
