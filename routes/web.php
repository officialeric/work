<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SaadaniController;

// Storage route for serving files (for cPanel deployment)
// Place this first to ensure it gets the correct name
Route::get('storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
        abort(404);
    }

    $mimeType = mime_content_type($fullPath);

    return response()->file($fullPath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000', // Cache for 1 year
    ]);
})->where('path', '.*')->name('storage.serve');

Route::get('/', [SaadaniController::class, 'index'])->name('saadani.index');

// Booking Routes
Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/create', [App\Http\Controllers\BookingController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\BookingController::class, 'store'])->name('store');
    Route::get('/confirmation/{bookingReference}', [App\Http\Controllers\BookingController::class, 'confirmation'])->name('confirmation');
});

// API Routes for AJAX
Route::prefix('api/booking')->group(function () {
    Route::get('/room-type/{id}', [App\Http\Controllers\BookingController::class, 'getRoomTypeDetails']);
    Route::post('/calculate-total', [App\Http\Controllers\BookingController::class, 'calculateTotal']);
});

// Keep the original welcome route for reference
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');



// Admin Routes
Route::prefix('admin')->group(base_path('routes/admin.php'));
