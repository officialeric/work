@extends('layouts.app')

@section('title', 'Booking Confirmation - ' . config('app.name'))
@section('description', 'Your booking request has been submitted successfully. We will contact you shortly to confirm your reservation.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-golden-50/30 py-12">
    <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12">
        <!-- Success Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-full mb-6">
                <i class="fas fa-check text-white text-3xl"></i>
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-bold bg-gradient-to-r from-golden-800 to-amber-700 bg-clip-text text-transparent mb-6">
                Booking Submitted Successfully!
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-golden-600 to-amber-500 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Thank you for choosing Saadani Kasa Bay. Your booking request has been received and we will contact you shortly to confirm your reservation.
            </p>
        </div>

        <!-- Booking Details Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-golden-200/50 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-golden-600 to-amber-600 p-6">
                <h2 class="text-2xl font-bold text-white">Booking Details</h2>
                <p class="text-golden-100 mt-2">Reference: <span class="font-bold">{{ $booking->booking_reference }}</span></p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Guest Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2 mb-4">Guest Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Name:</span>
                                    <span class="font-medium">{{ $booking->guest_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-medium">{{ $booking->guest_email }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Phone:</span>
                                    <span class="font-medium">{{ $booking->guest_phone }}</span>
                                </div>
                                @if($booking->guest_country)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Country:</span>
                                    <span class="font-medium">{{ $booking->guest_country }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if($booking->special_requests || $booking->dietary_requirements)
                        <div>
                            <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2 mb-4">Special Requests</h3>
                            @if($booking->special_requests)
                            <div class="mb-3">
                                <span class="text-gray-600 block mb-1">Special Requests:</span>
                                <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $booking->special_requests }}</p>
                            </div>
                            @endif
                            @if($booking->dietary_requirements)
                            <div>
                                <span class="text-gray-600 block mb-1">Dietary Requirements:</span>
                                <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $booking->dietary_requirements }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Booking Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2 mb-4">Reservation Details</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Room Type:</span>
                                    <span class="font-medium">{{ $booking->roomType->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Check-in:</span>
                                    <span class="font-medium">{{ $booking->check_in_date->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Check-out:</span>
                                    <span class="font-medium">{{ $booking->check_out_date->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-medium">{{ $booking->duration }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Guests:</span>
                                    <span class="font-medium">{{ $booking->number_of_guests }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2 mb-4">Pricing</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Rate per night:</span>
                                    <span class="font-medium">{{ $booking->currency }} {{ number_format($booking->room_rate, 0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Number of nights:</span>
                                    <span class="font-medium">{{ $booking->number_of_nights }}</span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-golden-800">Total Amount:</span>
                                        <span class="text-golden-800">{{ $booking->formatted_total }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-golden-800 border-b border-golden-200 pb-2 mb-4">Status</h3>
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $booking->status_color }}">
                                <i class="fas fa-clock mr-2"></i>
                                {{ ucfirst($booking->status) }}
                            </div>
                            <p class="text-gray-600 text-sm mt-2">
                                Your booking is currently pending confirmation. We will contact you within 24 hours to confirm your reservation and provide payment instructions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-gradient-to-r from-golden-100 to-amber-100 rounded-3xl p-8 border border-golden-300 mb-8">
            <h3 class="text-2xl font-bold text-golden-800 mb-6">What Happens Next?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-golden-600 text-white rounded-full mb-4">
                        <span class="font-bold">1</span>
                    </div>
                    <h4 class="font-bold text-golden-800 mb-2">Confirmation</h4>
                    <p class="text-golden-700 text-sm">We'll review your booking and contact you within 24 hours to confirm availability.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-golden-600 text-white rounded-full mb-4">
                        <span class="font-bold">2</span>
                    </div>
                    <h4 class="font-bold text-golden-800 mb-2">Payment</h4>
                    <p class="text-golden-700 text-sm">Once confirmed, we'll provide secure payment instructions and options.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-golden-600 text-white rounded-full mb-4">
                        <span class="font-bold">3</span>
                    </div>
                    <h4 class="font-bold text-golden-800 mb-2">Enjoy Your Stay</h4>
                    <p class="text-golden-700 text-sm">Arrive and enjoy your luxury experience at Saadani Kasa Bay!</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-3xl shadow-lg border border-golden-200/50 p-8 mb-8">
            <h3 class="text-2xl font-bold text-golden-800 mb-6">Need Assistance?</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-bold text-gray-800 mb-2">Contact Our Reservations Team</h4>
                    <p class="text-gray-600 mb-4">If you have any questions about your booking or need to make changes, please don't hesitate to contact us.</p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-golden-600"></i>
                            <span class="text-gray-700">reservations@saadanikasabay.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-golden-600"></i>
                            <span class="text-gray-700">+255 123 456 789</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 mb-2">Booking Reference</h4>
                    <p class="text-gray-600 mb-4">Please keep this reference number for your records and mention it in all communications:</p>
                    <div class="bg-golden-50 border border-golden-200 rounded-lg p-4">
                        <span class="text-2xl font-bold text-golden-800">{{ $booking->booking_reference }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('saadani.index') }}" 
                   class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-golden-600 to-amber-600 hover:from-golden-700 hover:to-amber-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-home"></i>
                    Return to Homepage
                </a>
                <button onclick="window.print()" 
                        class="inline-flex items-center justify-center gap-3 bg-white border-2 border-golden-600 text-golden-600 hover:bg-golden-600 hover:text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-print"></i>
                    Print Confirmation
                </button>
            </div>
            <p class="text-gray-500 text-sm">
                A confirmation email has been sent to {{ $booking->guest_email }}
            </p>
        </div>
    </div>
</div>
@endsection
