<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Guest Information
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone');
            $table->string('guest_country')->nullable();
            $table->text('guest_address')->nullable();
            
            // Booking Details
            $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('number_of_guests');
            $table->integer('number_of_nights');
            
            // Pricing
            $table->decimal('room_rate', 10, 2); // Rate per night at time of booking
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            
            // Special Requests
            $table->text('special_requests')->nullable();
            $table->text('dietary_requirements')->nullable();
            
            // Booking Status
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed', 'no_show'])->default('pending');
            $table->text('admin_notes')->nullable();
            
            // Payment Information (for future use)
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending');
            $table->decimal('amount_paid', 10, 2)->default(0);
            
            // Booking Reference
            $table->string('booking_reference')->unique();
            
            // Timestamps
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'check_in_date']);
            $table->index(['guest_email']);
            $table->index(['booking_reference']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
