<?php

/**
 * Test script to verify booking functionality
 * Run this with: php artisan tinker
 * Then paste: include 'test-booking-functionality.php';
 */

echo "=== Booking Functionality Test ===\n\n";

// Check if we have any bookings
$bookingCount = \App\Models\Booking::count();
echo "Total bookings in system: {$bookingCount}\n";

// Check if we have room types
$roomTypeCount = \App\Models\RoomType::count();
echo "Total room types: {$roomTypeCount}\n";

if ($roomTypeCount === 0) {
    echo "❌ No room types found. Please create room types first.\n";
    return;
}

// Get the first room type
$roomType = \App\Models\RoomType::first();
echo "Using room type: {$roomType->name} (Price: {$roomType->currency} {$roomType->price})\n\n";

// Create a test booking if none exist
if ($bookingCount === 0) {
    echo "Creating a test booking...\n";
    
    $booking = \App\Models\Booking::create([
        'guest_name' => 'Test Guest',
        'guest_email' => 'test@example.com',
        'guest_phone' => '+1234567890',
        'guest_country' => 'Test Country',
        'room_type_id' => $roomType->id,
        'check_in_date' => now()->addDays(7)->toDateString(),
        'check_out_date' => now()->addDays(10)->toDateString(),
        'number_of_guests' => 2,
        'number_of_nights' => 3,
        'room_rate' => $roomType->price,
        'total_amount' => $roomType->price * 3,
        'currency' => $roomType->currency,
        'booking_reference' => \App\Models\Booking::generateBookingReference(),
        'status' => 'pending',
    ]);
    
    echo "✅ Test booking created: {$booking->booking_reference}\n";
} else {
    $booking = \App\Models\Booking::first();
    echo "Using existing booking: {$booking->booking_reference}\n";
}

echo "\n=== Testing Booking Methods ===\n";

// Test canBeConfirmed method
echo "Can be confirmed: " . ($booking->canBeConfirmed() ? 'Yes' : 'No') . "\n";

// Test canBeCancelled method  
echo "Can be cancelled: " . ($booking->canBeCancelled() ? 'Yes' : 'No') . "\n";

// Test status color
echo "Status color classes: {$booking->status_color}\n";

// Test formatted total
echo "Formatted total: {$booking->formatted_total}\n";

// Test duration
echo "Duration: {$booking->duration}\n";

echo "\n=== Route Testing ===\n";

// Test route generation
try {
    $confirmRoute = route('admin.bookings.confirm', $booking);
    echo "✅ Confirm route: {$confirmRoute}\n";
} catch (Exception $e) {
    echo "❌ Confirm route error: {$e->getMessage()}\n";
}

try {
    $cancelRoute = route('admin.bookings.cancel', $booking);
    echo "✅ Cancel route: {$cancelRoute}\n";
} catch (Exception $e) {
    echo "❌ Cancel route error: {$e->getMessage()}\n";
}

try {
    $showRoute = route('admin.bookings.show', $booking);
    echo "✅ Show route: {$showRoute}\n";
} catch (Exception $e) {
    echo "❌ Show route error: {$e->getMessage()}\n";
}

echo "\n=== Testing Complete ===\n";
echo "If all routes show ✅, the booking confirmation functionality should work properly.\n";
echo "The HTTP method mismatch has been fixed by removing @method('PATCH') from the forms.\n";
