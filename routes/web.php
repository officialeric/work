<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaadaniController;

Route::get('/', [SaadaniController::class, 'index'])->name('saadani.index');

// Keep the original welcome route for reference
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Admin Routes
Route::prefix('admin')->group(base_path('routes/admin.php'));
