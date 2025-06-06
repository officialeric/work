<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_name',
        'guest_email',
        'guest_phone',
        'guest_country',
        'guest_address',
        'room_type_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'number_of_nights',
        'room_rate',
        'total_amount',
        'currency',
        'special_requests',
        'dietary_requirements',
        'status',
        'admin_notes',
        'payment_status',
        'amount_paid',
        'booking_reference',
        'confirmed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'number_of_guests' => 'integer',
        'number_of_nights' => 'integer',
        'room_rate' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Relationship with RoomType
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Generate unique booking reference
     */
    public static function generateBookingReference(): string
    {
        do {
            $reference = 'SKB-' . strtoupper(substr(uniqid(), -8));
        } while (self::where('booking_reference', $reference)->exists());
        
        return $reference;
    }

    /**
     * Calculate number of nights between dates
     */
    public static function calculateNights($checkIn, $checkOut): int
    {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        
        return $checkInDate->diffInDays($checkOutDate);
    }

    /**
     * Calculate total amount
     */
    public function calculateTotalAmount(): float
    {
        return $this->room_rate * $this->number_of_nights;
    }

    /**
     * Scope for filtering by status
     */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for upcoming bookings
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('check_in_date', '>=', now()->toDateString());
    }

    /**
     * Scope for current bookings (guests currently staying)
     */
    public function scopeCurrent(Builder $query): Builder
    {
        $today = now()->toDateString();
        return $query->where('check_in_date', '<=', $today)
                    ->where('check_out_date', '>', $today)
                    ->where('status', 'confirmed');
    }

    /**
     * Scope for past bookings
     */
    public function scopePast(Builder $query): Builder
    {
        return $query->where('check_out_date', '<', now()->toDateString());
    }

    /**
     * Get formatted total amount
     */
    public function getFormattedTotalAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->total_amount, 0);
    }

    /**
     * Get booking duration in human readable format
     */
    public function getDurationAttribute(): string
    {
        if ($this->number_of_nights === 1) {
            return '1 night';
        }
        
        return $this->number_of_nights . ' nights';
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']) && 
               $this->check_in_date > now()->toDateString();
    }

    /**
     * Check if booking can be confirmed
     */
    public function canBeConfirmed(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Confirm the booking
     */
    public function confirm(): void
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);
    }

    /**
     * Cancel the booking
     */
    public function cancel(): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'no_show' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
