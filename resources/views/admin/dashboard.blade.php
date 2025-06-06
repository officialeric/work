@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Message -->
    <div class="bg-gradient-to-r from-golden-500 to-golden-600 rounded-xl p-4 sm:p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold mb-2">Welcome back, {{ Auth::guard('admin')->user()->name }}!</h1>
                <p class="text-golden-100 text-sm sm:text-base">Manage your Saadani Kasa Bay website content from here.</p>
            </div>
            <div class="hidden sm:block">
                <i class="fas fa-tachometer-alt text-3xl sm:text-4xl text-golden-200"></i>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
        <!-- Activities -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Activities</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['activities'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hiking text-blue-600 text-lg sm:text-xl"></i>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <a href="{{ route('admin.activities.index') }}"
                   class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Manage Activities →
                </a>
            </div>
        </div>

        <!-- Amenities -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Amenities</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['amenities'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-concierge-bell text-green-600 text-lg sm:text-xl"></i>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <a href="{{ route('admin.amenities.index') }}"
                   class="text-sm text-green-600 hover:text-green-800 font-medium">
                    Manage Amenities →
                </a>
            </div>
        </div>

        <!-- Commitments -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Commitments</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['commitments'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-golden-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-leaf text-golden-600 text-lg sm:text-xl"></i>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <a href="{{ route('admin.commitments.index') }}"
                   class="text-sm text-golden-600 hover:text-golden-800 font-medium">
                    Manage Commitments →
                </a>
            </div>
        </div>

        <!-- Gallery Images -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Gallery Images</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['gallery_images'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-images text-purple-600 text-lg sm:text-xl"></i>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <a href="{{ route('admin.gallery.index') }}"
                   class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                    Manage Gallery →
                </a>
            </div>
        </div>

        <!-- Room Types -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Room Types</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['room_types'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-door-open text-amber-600 text-lg sm:text-xl"></i>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <a href="{{ route('admin.room-types.index') }}"
                   class="text-sm text-amber-600 hover:text-amber-800 font-medium">
                    Manage Room Types →
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.activities.create') }}"
                   class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-plus text-white text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium text-sm sm:text-base">+ Add New Activity</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}"
                   class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                    <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-upload text-white text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium text-sm sm:text-base">+ Add Gallery Images</span>
                </a>

                <a href="{{ route('admin.room-types.create') }}"
                   class="flex items-center p-3 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors duration-200">
                    <div class="w-8 h-8 bg-amber-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-plus text-white text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium text-sm sm:text-base">+ Add New Room Type</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-cog text-white text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium text-sm sm:text-base">Website Settings</span>
                </a>

                <a href="{{ route('saadani.index') }}"
                   target="_blank"
                   class="flex items-center p-3 bg-golden-50 hover:bg-golden-100 rounded-lg transition-colors duration-200">
                    <div class="w-8 h-8 bg-golden-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-external-link-alt text-white text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium text-sm sm:text-base">View Website</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
            @if($recentActivities->count() > 0)
                <div class="space-y-3">
                    @foreach($recentActivities as $activity)
                        <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-gray-600 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900 break-words">
                                    <span class="font-medium">{{ $activity->admin->name }}</span>
                                    {{ $activity->action }}
                                    @if($activity->model_type)
                                        {{ class_basename($activity->model_type) }}
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-history text-gray-300 text-3xl mb-3"></i>
                    <p class="text-gray-500 text-sm sm:text-base">No recent activity</p>
                </div>
            @endif
        </div>
    </div>

    <!-- System Info -->
    <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">System Information</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div class="text-center p-3 sm:p-0">
                <div class="text-xl sm:text-2xl font-bold text-golden-600 break-words">{{ Auth::guard('admin')->user()->last_login_at ? Auth::guard('admin')->user()->last_login_at->format('M j, Y') : 'Never' }}</div>
                <div class="text-sm text-gray-600">Last Login</div>
            </div>
            <div class="text-center p-3 sm:p-0">
                <div class="text-xl sm:text-2xl font-bold text-blue-600">{{ date('M j, Y') }}</div>
                <div class="text-sm text-gray-600">Today's Date</div>
            </div>
            <div class="text-center p-3 sm:p-0">
                <div class="text-xl sm:text-2xl font-bold text-purple-600 break-words">Laravel {{ app()->version() }}</div>
                <div class="text-sm text-gray-600">Framework Version</div>
            </div>
        </div>
    </div>
</div>
@endsection
