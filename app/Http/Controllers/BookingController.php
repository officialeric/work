<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show the booking form
     */
    public function create(Request $request)
    {
        $roomTypes = RoomType::active()->ordered()->get();
        $selectedRoomType = null;
        
        // If room type is specified in URL
        if ($request->has('room_type')) {
            $selectedRoomType = RoomType::find($request->room_type);
        }
        
        return view('booking.create', compact('roomTypes', 'selectedRoomType'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'guest_country' => 'nullable|string|max:100',
            'guest_address' => 'nullable|string|max:500',
            'room_type_id' => 'required|exists:room_types,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1|max:10',
            'special_requests' => 'nullable|string|max:1000',
            'dietary_requirements' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $roomType = RoomType::findOrFail($request->room_type_id);
        
        // Calculate nights and total
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);
        
        if ($numberOfNights < 1) {
            return back()->withErrors(['check_out_date' => 'Check-out date must be at least 1 day after check-in date.'])->withInput();
        }

        // Check room capacity
        if ($request->number_of_guests > $roomType->max_occupancy) {
            return back()->withErrors(['number_of_guests' => "This room type can accommodate maximum {$roomType->max_occupancy} guests."])->withInput();
        }

        $totalAmount = $roomType->price * $numberOfNights;

        // Create booking
        $booking = Booking::create([
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'guest_country' => $request->guest_country,
            'guest_address' => $request->guest_address,
            'room_type_id' => $request->room_type_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'number_of_guests' => $request->number_of_guests,
            'number_of_nights' => $numberOfNights,
            'room_rate' => $roomType->price,
            'total_amount' => $totalAmount,
            'currency' => $roomType->currency,
            'special_requests' => $request->special_requests,
            'dietary_requirements' => $request->dietary_requirements,
            'booking_reference' => Booking::generateBookingReference(),
            'status' => 'pending',
        ]);

        return redirect()->route('booking.confirmation', $booking->booking_reference)
                        ->with('success', 'Your booking request has been submitted successfully!');
    }

    /**
     * Show booking confirmation
     */
    public function confirmation($bookingReference)
    {
        $booking = Booking::where('booking_reference', $bookingReference)
                         ->with('roomType')
                         ->firstOrFail();
        
        return view('booking.confirmation', compact('booking'));
    }

    /**
     * Get room type details for AJAX
     */
    public function getRoomTypeDetails($id)
    {
        $roomType = RoomType::findOrFail($id);
        
        return response()->json([
            'name' => $roomType->name,
            'description' => $roomType->description,
            'price' => $roomType->price,
            'currency' => $roomType->currency,
            'max_occupancy' => $roomType->max_occupancy,
            'features' => $roomType->features,
            'formatted_price' => $roomType->formatted_price,
        ]);
    }

    /**
     * Calculate booking total for AJAX
     */
    public function calculateTotal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_type_id' => 'required|exists:room_types,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid dates'], 400);
        }

        $roomType = RoomType::findOrFail($request->room_type_id);
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);
        
        if ($numberOfNights < 1) {
            return response()->json(['error' => 'Invalid date range'], 400);
        }

        $totalAmount = $roomType->price * $numberOfNights;

        return response()->json([
            'nights' => $numberOfNights,
            'room_rate' => $roomType->price,
            'total_amount' => $totalAmount,
            'currency' => $roomType->currency,
            'formatted_total' => $roomType->currency . ' ' . number_format($totalAmount, 0),
        ]);
    }
}
