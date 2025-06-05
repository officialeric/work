<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Commitment;
use App\Models\GalleryImage;
use App\Models\AdminActivityLog;
use App\Models\RoomType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'activities' => Activity::count(),
            'amenities' => Amenity::count(),
            'commitments' => Commitment::count(),
            'gallery_images' => GalleryImage::count(),
            'room_types' => RoomType::count(),
        ];

        $recentActivities = AdminActivityLog::with('admin')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}
