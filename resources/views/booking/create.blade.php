@extends('layouts.app')

@section('title', 'Book Your Stay - ' . config('app.name'))
@section('description', 'Book your luxury accommodation at Saadani Kasa Bay. Choose from our range of premium room types and enjoy an unforgettable experience.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-golden-50/30 pt-24 pb-12">
    <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="font-display text-4xl md:text-5xl font-bold bg-gradient-to-r from-golden-800 to-amber-700 bg-clip-text text-transparent mb-6">
                Book Your Stay
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-golden-600 to-amber-500 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Reserve your luxury accommodation at Saadani Kasa Bay and create unforgettable memories in paradise.
            </p>
        </div>

        <!-- Booking Form -->
        <div class="bg-white rounded-3xl shadow-xl border border-golden-200/50 overflow-hidden">
            <div class="bg-gradient-to-r from-golden-600 to-amber-600 p-6">
                <h2 class="text-2xl font-bold text-white">Reservation Details</h2>
                <p class="text-golden-100 mt-2">Please fill in your information to complete your booking</p>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" class="p-8 space-y-8" id="booking-form">
                @csrf

                <!-- Room Selection -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2">Room Selection</h3>
                    
                    <div>
                        <label for="room_type_id" class="block text-sm font-medium text-gray-700 mb-2">Room Type *</label>
                        <select name="room_type_id" id="room_type_id" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            <option value="">Select a room type</option>
                            @foreach($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}" 
                                        data-price="{{ $roomType->price }}"
                                        data-currency="{{ $roomType->currency }}"
                                        data-max-occupancy="{{ $roomType->max_occupancy }}"
                                        {{ old('room_type_id', $selectedRoomType?->id) == $roomType->id ? 'selected' : '' }}>
                                    {{ $roomType->name }} - {{ $roomType->formatted_price }}/night
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Room Details Display -->
                    <div id="room-details" class="hidden bg-golden-50 rounded-xl p-4 border border-golden-200">
                        <div id="room-info"></div>
                    </div>
                </div>

                <!-- Dates and Guests -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2">Stay Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-2">Check-in Date *</label>
                            <input type="date" name="check_in_date" id="check_in_date" required
                                   min="{{ date('Y-m-d') }}"
                                   value="{{ old('check_in_date') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            @error('check_in_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-2">Check-out Date *</label>
                            <input type="date" name="check_out_date" id="check_out_date" required
                                   value="{{ old('check_out_date') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            @error('check_out_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="number_of_guests" class="block text-sm font-medium text-gray-700 mb-2">Number of Guests *</label>
                            <select name="number_of_guests" id="number_of_guests" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                                <option value="">Select guests</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('number_of_guests') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}
                                    </option>
                                @endfor
                            </select>
                            @error('number_of_guests')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div id="booking-summary" class="hidden bg-gradient-to-r from-golden-100 to-amber-100 rounded-xl p-4 border border-golden-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-golden-700">Total for <span id="nights-count">0</span> nights</p>
                                <p class="text-2xl font-bold text-golden-800" id="total-amount">$0</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-golden-700">Rate per night</p>
                                <p class="text-lg font-semibold text-golden-800" id="room-rate">$0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guest Information -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2">Guest Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="guest_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="guest_name" id="guest_name" required
                                   value="{{ old('guest_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            @error('guest_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="guest_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" name="guest_email" id="guest_email" required
                                   value="{{ old('guest_email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            @error('guest_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="guest_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                            <input type="tel" name="guest_phone" id="guest_phone" required
                                   value="{{ old('guest_phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            @error('guest_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="guest_country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" name="guest_country" id="guest_country"
                                   value="{{ old('guest_country') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">
                            @error('guest_country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="guest_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="guest_address" id="guest_address" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">{{ old('guest_address') }}</textarea>
                        @error('guest_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Special Requests -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2">Special Requests</h3>
                    
                    <div>
                        <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                        <textarea name="special_requests" id="special_requests" rows="3"
                                  placeholder="Any special requests or preferences for your stay..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">{{ old('special_requests') }}</textarea>
                        @error('special_requests')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dietary_requirements" class="block text-sm font-medium text-gray-700 mb-2">Dietary Requirements</label>
                        <textarea name="dietary_requirements" id="dietary_requirements" rows="2"
                                  placeholder="Any dietary restrictions or food allergies..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-golden-500 focus:border-golden-500 transition-colors">{{ old('dietary_requirements') }}</textarea>
                        @error('dietary_requirements')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                        <a href="{{ route('saadani.index') }}#room-types" 
                           class="inline-flex items-center gap-2 text-golden-600 hover:text-golden-700 font-medium">
                            <i class="fas fa-arrow-left"></i>
                            Back to Room Types
                        </a>
                        
                        <button type="submit" 
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-golden-600 to-amber-600 hover:from-golden-700 hover:to-amber-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-calendar-check"></i>
                            Submit Booking Request
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
