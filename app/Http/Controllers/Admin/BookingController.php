<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
        $query = Booking::with('roomType');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('guest_name', 'like', "%{$search}%")
                  ->orWhere('guest_email', 'like', "%{$search}%")
                  ->orWhere('guest_phone', 'like', "%{$search}%")
                  ->orWhere('booking_reference', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->where('check_in_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('check_in_date', '<=', $request->date_to);
        }

        // Room type filter
        if ($request->filled('room_type')) {
            $query->where('room_type_id', $request->room_type);
        }

        // Sort by check-in date (newest first by default)
        $query->orderBy('check_in_date', 'desc');

        $bookings = $query->paginate(20)->withQueryString();

        // Get filter options
        $roomTypes = RoomType::active()->orderBy('name')->get();
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed', 'no_show'];

        // Get statistics
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'upcoming' => Booking::upcoming()->where('status', 'confirmed')->count(),
            'current' => Booking::current()->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'roomTypes', 'statuses', 'stats'));
    }

    /**
     * Display the specified booking
     */
    public function show(Booking $booking)
    {
        $booking->load('roomType');
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit(Booking $booking)
    {
        $roomTypes = RoomType::active()->ordered()->get();
        return view('admin.bookings.edit', compact('booking', 'roomTypes'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'guest_country' => 'nullable|string|max:100',
            'guest_address' => 'nullable|string|max:500',
            'room_type_id' => 'required|exists:room_types,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1|max:10',
            'special_requests' => 'nullable|string|max:1000',
            'dietary_requirements' => 'nullable|string|max:500',
            'admin_notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,confirmed,cancelled,completed,no_show',
        ]);

        $oldValues = $booking->toArray();

        // Recalculate if room type or dates changed
        if ($booking->room_type_id != $request->room_type_id || 
            $booking->check_in_date != $request->check_in_date || 
            $booking->check_out_date != $request->check_out_date) {
            
            $roomType = RoomType::findOrFail($request->room_type_id);
            $numberOfNights = Booking::calculateNights($request->check_in_date, $request->check_out_date);
            $totalAmount = $roomType->price * $numberOfNights;

            $request->merge([
                'number_of_nights' => $numberOfNights,
                'room_rate' => $roomType->price,
                'total_amount' => $totalAmount,
                'currency' => $roomType->currency,
            ]);
        }

        $booking->update($request->all());

        // Log the activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $booking,
            $oldValues,
            $booking->fresh()->toArray()
        );

        return redirect()->route('admin.bookings.show', $booking)
                        ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking
     */
    public function destroy(Booking $booking)
    {
        $oldValues = $booking->toArray();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            $booking,
            $oldValues,
            null
        );

        $booking->delete();

        return redirect()->route('admin.bookings.index')
                        ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Confirm a booking
     */
    public function confirm(Booking $booking)
    {
        if (!$booking->canBeConfirmed()) {
            return back()->with('error', 'This booking cannot be confirmed.');
        }

        $oldStatus = $booking->status;
        $booking->confirm();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'confirmed',
            $booking,
            ['status' => $oldStatus],
            ['status' => 'confirmed', 'confirmed_at' => $booking->confirmed_at]
        );

        return back()->with('success', 'Booking confirmed successfully.');
    }

    /**
     * Cancel a booking
     */
    public function cancel(Booking $booking)
    {
        if (!$booking->canBeCancelled()) {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        $oldStatus = $booking->status;
        $booking->cancel();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'cancelled',
            $booking,
            ['status' => $oldStatus],
            ['status' => 'cancelled', 'cancelled_at' => $booking->cancelled_at]
        );

        return back()->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Export bookings to CSV
     */
    public function export(Request $request)
    {
        $query = Booking::with('roomType');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->where('check_in_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('check_in_date', '<=', $request->date_to);
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();

        $filename = 'bookings_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Booking Reference',
                'Guest Name',
                'Guest Email',
                'Guest Phone',
                'Room Type',
                'Check In',
                'Check Out',
                'Nights',
                'Guests',
                'Total Amount',
                'Status',
                'Created At'
            ]);

            // CSV data
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->booking_reference,
                    $booking->guest_name,
                    $booking->guest_email,
                    $booking->guest_phone,
                    $booking->roomType->name,
                    $booking->check_in_date->format('Y-m-d'),
                    $booking->check_out_date->format('Y-m-d'),
                    $booking->number_of_nights,
                    $booking->number_of_guests,
                    $booking->formatted_total,
                    ucfirst($booking->status),
                    $booking->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
