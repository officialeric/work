@extends('admin.layouts.app')

@section('title', 'Booking Details - ' . $booking->booking_reference)
@section('page-title', 'Booking Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $booking->booking_reference }}</h1>
            <p class="text-gray-600">Created {{ $booking->created_at->format('M d, Y \a\t g:i A') }}</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.bookings.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Bookings
            </a>
            <a href="{{ route('admin.bookings.edit', $booking) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Booking
            </a>
        </div>
    </div>

    <!-- Status and Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Current Status</h3>
                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $booking->status_color }}">
                    {{ ucfirst($booking->status) }}
                </span>
                @if($booking->confirmed_at)
                    <p class="text-sm text-gray-600 mt-2">Confirmed on {{ $booking->confirmed_at->format('M d, Y \a\t g:i A') }}</p>
                @endif
                @if($booking->cancelled_at)
                    <p class="text-sm text-gray-600 mt-2">Cancelled on {{ $booking->cancelled_at->format('M d, Y \a\t g:i A') }}</p>
                @endif
            </div>

            <!-- Quick Status Actions -->
            <div class="flex flex-wrap gap-2">
                @if($booking->status === 'pending')
                    <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors duration-200"
                                onclick="return confirm('Are you sure you want to confirm this booking?')">
                            <i class="fas fa-check mr-2"></i>Confirm
                        </button>
                    </form>
                @endif

                @if(in_array($booking->status, ['pending', 'confirmed']))
                    <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors duration-200"
                                onclick="return confirm('Are you sure you want to cancel this booking?')">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </form>
                @endif

                @if($booking->status === 'confirmed' && $booking->check_out_date < now())
                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200"
                                onclick="return confirm('Mark this booking as completed?')">
                            <i class="fas fa-check-circle mr-2"></i>Mark Completed
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Booking Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Guest Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Guest Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Name:</span>
                    <span class="font-medium text-gray-900">{{ $booking->guest_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-medium text-gray-900">
                        <a href="mailto:{{ $booking->guest_email }}" class="text-blue-600 hover:text-blue-800">
                            {{ $booking->guest_email }}
                        </a>
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Phone:</span>
                    <span class="font-medium text-gray-900">
                        <a href="tel:{{ $booking->guest_phone }}" class="text-blue-600 hover:text-blue-800">
                            {{ $booking->guest_phone }}
                        </a>
                    </span>
                </div>
                @if($booking->guest_country)
                <div class="flex justify-between">
                    <span class="text-gray-600">Country:</span>
                    <span class="font-medium text-gray-900">{{ $booking->guest_country }}</span>
                </div>
                @endif
                @if($booking->guest_address)
                <div class="flex justify-between">
                    <span class="text-gray-600">Address:</span>
                    <span class="font-medium text-gray-900">{{ $booking->guest_address }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Reservation Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Reservation Details</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Room Type:</span>
                    <span class="font-medium text-gray-900">{{ $booking->roomType->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Check-in:</span>
                    <span class="font-medium text-gray-900">{{ $booking->check_in_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Check-out:</span>
                    <span class="font-medium text-gray-900">{{ $booking->check_out_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Duration:</span>
                    <span class="font-medium text-gray-900">{{ $booking->duration }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Number of Guests:</span>
                    <span class="font-medium text-gray-900">{{ $booking->number_of_guests }}</span>
                </div>
            </div>
        </div>

        <!-- Pricing Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pricing Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Rate per night:</span>
                    <span class="font-medium text-gray-900">{{ $booking->currency }} {{ number_format($booking->room_rate, 0) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Number of nights:</span>
                    <span class="font-medium text-gray-900">{{ $booking->number_of_nights }}</span>
                </div>
                <div class="border-t border-gray-200 pt-3">
                    <div class="flex justify-between text-lg">
                        <span class="font-semibold text-gray-900">Total Amount:</span>
                        <span class="font-bold text-golden-600">{{ $booking->formatted_total }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Special Requests -->
        @if($booking->special_requests || $booking->dietary_requirements)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Special Requests</h3>
            <div class="space-y-4">
                @if($booking->special_requests)
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Special Requests:</h4>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $booking->special_requests }}</p>
                </div>
                @endif
                @if($booking->dietary_requirements)
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Dietary Requirements:</h4>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $booking->dietary_requirements }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Admin Notes -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Notes</h3>
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <textarea name="admin_notes" 
                              rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500"
                              placeholder="Add internal notes about this booking...">{{ $booking->admin_notes }}</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-golden-600 text-white rounded-lg hover:bg-golden-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Save Notes
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6">
        <h3 class="text-lg font-semibold text-red-900 mb-4">Danger Zone</h3>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h4 class="font-medium text-red-900">Delete Booking</h4>
                <p class="text-sm text-red-700">Permanently delete this booking. This action cannot be undone.</p>
            </div>
            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200"
                        onclick="return confirm('Are you sure you want to delete this booking? This action cannot be undone.')">
                    <i class="fas fa-trash mr-2"></i>Delete Booking
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
