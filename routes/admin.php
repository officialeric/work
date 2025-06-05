<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\CommitmentController;
use App\Http\Controllers\Admin\GalleryController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes (Guest Only)
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('admin.password.request');
    Route::post('/reset-password', [AuthController::class, 'sendResetLink'])->name('admin.password.email');
});

// Admin Protected Routes
Route::middleware(['admin.auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Authentication
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Profile Management
    Route::prefix('profile')->name('admin.profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
        Route::put('/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('password');
    });
    
    // Website Settings
    Route::prefix('settings')->name('admin.settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/', [SettingsController::class, 'update'])->name('update');
        Route::post('/reset', [SettingsController::class, 'reset'])->name('reset');
    });
    
    // Activities Management
    Route::prefix('activities')->name('admin.activities.')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/create', [ActivityController::class, 'create'])->name('create');
        Route::post('/', [ActivityController::class, 'store'])->name('store');
        Route::get('/{activity}/edit', [ActivityController::class, 'edit'])->name('edit');
        Route::put('/{activity}', [ActivityController::class, 'update'])->name('update');
        Route::delete('/{activity}', [ActivityController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [ActivityController::class, 'updateOrder'])->name('update-order');
    });
    
    // Amenities Management
    Route::prefix('amenities')->name('admin.amenities.')->group(function () {
        Route::get('/', [AmenityController::class, 'index'])->name('index');
        Route::get('/create', [AmenityController::class, 'create'])->name('create');
        Route::post('/', [AmenityController::class, 'store'])->name('store');
        Route::get('/{amenity}/edit', [AmenityController::class, 'edit'])->name('edit');
        Route::put('/{amenity}', [AmenityController::class, 'update'])->name('update');
        Route::delete('/{amenity}', [AmenityController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [AmenityController::class, 'updateOrder'])->name('update-order');
    });
    
    // Commitments Management
    Route::prefix('commitments')->name('admin.commitments.')->group(function () {
        Route::get('/', [CommitmentController::class, 'index'])->name('index');
        Route::get('/create', [CommitmentController::class, 'create'])->name('create');
        Route::post('/', [CommitmentController::class, 'store'])->name('store');
        Route::get('/{commitment}/edit', [CommitmentController::class, 'edit'])->name('edit');
        Route::put('/{commitment}', [CommitmentController::class, 'update'])->name('update');
        Route::delete('/{commitment}', [CommitmentController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [CommitmentController::class, 'updateOrder'])->name('update-order');
    });
    
    // Gallery Management
    Route::prefix('gallery')->name('admin.gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::post('/upload', [GalleryController::class, 'upload'])->name('upload');
        Route::put('/{image}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/{image}', [GalleryController::class, 'destroy'])->name('destroy');
        Route::post('/update-order', [GalleryController::class, 'updateOrder'])->name('update-order');
        Route::post('/bulk-delete', [GalleryController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Locations Management
    Route::resource('locations', App\Http\Controllers\Admin\LocationController::class)->names([
        'index' => 'admin.locations.index',
        'create' => 'admin.locations.create',
        'store' => 'admin.locations.store',
        'show' => 'admin.locations.show',
        'edit' => 'admin.locations.edit',
        'update' => 'admin.locations.update',
        'destroy' => 'admin.locations.destroy',
    ]);

    // Hosting Sections Management
    Route::resource('hosting-sections', App\Http\Controllers\Admin\HostingSectionController::class)->names([
        'index' => 'admin.hosting-sections.index',
        'create' => 'admin.hosting-sections.create',
        'store' => 'admin.hosting-sections.store',
        'show' => 'admin.hosting-sections.show',
        'edit' => 'admin.hosting-sections.edit',
        'update' => 'admin.hosting-sections.update',
        'destroy' => 'admin.hosting-sections.destroy',
    ]);
});
