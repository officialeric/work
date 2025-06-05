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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // DELUXE ROOM, DOUBLE ROOM, etc.
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Room price
            $table->string('currency', 3)->default('USD');
            
            // Tent Configuration
            $table->string('tent_type'); // Big Tent, Small Tents
            $table->integer('tent_quantity')->default(1); // Number of tents
            
            // Images
            $table->string('main_image')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            
            // Room Features
            $table->integer('max_occupancy')->nullable();
            $table->text('features')->nullable(); // JSON or text for room features
            
            // Management
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
