@extends('admin.layouts.app')

@section('title', 'Edit Booking - ' . $booking->booking_reference)
@section('page-title', 'Edit Booking')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Booking: {{ $booking->booking_reference }}</h1>
            <p class="text-gray-600">Update booking details and status</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.bookings.show', $booking) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Details
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Guest Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Guest Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="guest_name" class="block text-sm font-medium text-gray-700 mb-2">Guest Name *</label>
                    <input type="text" 
                           name="guest_name" 
                           id="guest_name"
                           value="{{ old('guest_name', $booking->guest_name) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('guest_name') border-red-500 @enderror">
                    @error('guest_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="guest_email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" 
                           name="guest_email" 
                           id="guest_email"
                           value="{{ old('guest_email', $booking->guest_email) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('guest_email') border-red-500 @enderror">
                    @error('guest_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="guest_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                    <input type="text" 
                           name="guest_phone" 
                           id="guest_phone"
                           value="{{ old('guest_phone', $booking->guest_phone) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('guest_phone') border-red-500 @enderror">
                    @error('guest_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="guest_country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <input type="text" 
                           name="guest_country" 
                           id="guest_country"
                           value="{{ old('guest_country', $booking->guest_country) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('guest_country') border-red-500 @enderror">
                    @error('guest_country')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="guest_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="guest_address" 
                              id="guest_address"
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('guest_address') border-red-500 @enderror">{{ old('guest_address', $booking->guest_address) }}</textarea>
                    @error('guest_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Reservation Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Reservation Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label for="room_type_id" class="block text-sm font-medium text-gray-700 mb-2">Room Type *</label>
                    <select name="room_type_id" 
                            id="room_type_id"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('room_type_id') border-red-500 @enderror">
                        <option value="">Select Room Type</option>
                        @foreach($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}" 
                                    {{ old('room_type_id', $booking->room_type_id) == $roomType->id ? 'selected' : '' }}
                                    data-price="{{ $roomType->price }}"
                                    data-currency="{{ $roomType->currency }}">
                                {{ $roomType->name }} ({{ $roomType->currency }} {{ number_format($roomType->price, 0) }}/night)
                            </option>
                        @endforeach
                    </select>
                    @error('room_type_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-2">Check-in Date *</label>
                    <input type="date" 
                           name="check_in_date" 
                           id="check_in_date"
                           value="{{ old('check_in_date', $booking->check_in_date->format('Y-m-d')) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('check_in_date') border-red-500 @enderror">
                    @error('check_in_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-2">Check-out Date *</label>
                    <input type="date" 
                           name="check_out_date" 
                           id="check_out_date"
                           value="{{ old('check_out_date', $booking->check_out_date->format('Y-m-d')) }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('check_out_date') border-red-500 @enderror">
                    @error('check_out_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="number_of_guests" class="block text-sm font-medium text-gray-700 mb-2">Number of Guests *</label>
                    <input type="number" 
                           name="number_of_guests" 
                           id="number_of_guests"
                           value="{{ old('number_of_guests', $booking->number_of_guests) }}"
                           min="1" 
                           max="10"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('number_of_guests') border-red-500 @enderror">
                    @error('number_of_guests')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" 
                            id="status"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status', $booking->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status', $booking->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ old('status', $booking->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="no_show" {{ old('status', $booking->status) === 'no_show' ? 'selected' : '' }}>No Show</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Special Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Special Requests</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                    <textarea name="special_requests" 
                              id="special_requests"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('special_requests') border-red-500 @enderror">{{ old('special_requests', $booking->special_requests) }}</textarea>
                    @error('special_requests')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dietary_requirements" class="block text-sm font-medium text-gray-700 mb-2">Dietary Requirements</label>
                    <textarea name="dietary_requirements" 
                              id="dietary_requirements"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('dietary_requirements') border-red-500 @enderror">{{ old('dietary_requirements', $booking->dietary_requirements) }}</textarea>
                    @error('dietary_requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Admin Notes -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Admin Notes</h3>
            <div>
                <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Internal Notes</label>
                <textarea name="admin_notes" 
                          id="admin_notes"
                          rows="4"
                          placeholder="Add internal notes about this booking..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-golden-500 focus:border-golden-500 @error('admin_notes') border-red-500 @enderror">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                @error('admin_notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.bookings.show', $booking) }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-6 py-3 bg-golden-600 text-white rounded-lg hover:bg-golden-700 transition-colors duration-200">
                <i class="fas fa-save mr-2"></i>Update Booking
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate nights when dates change
    const checkInDate = document.getElementById('check_in_date');
    const checkOutDate = document.getElementById('check_out_date');
    
    function calculateNights() {
        if (checkInDate.value && checkOutDate.value) {
            const checkIn = new Date(checkInDate.value);
            const checkOut = new Date(checkOutDate.value);
            const timeDiff = checkOut.getTime() - checkIn.getTime();
            const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            if (nights > 0) {
                console.log(`Calculated ${nights} nights`);
            }
        }
    }
    
    checkInDate.addEventListener('change', calculateNights);
    checkOutDate.addEventListener('change', calculateNights);
});
</script>
@endsection
