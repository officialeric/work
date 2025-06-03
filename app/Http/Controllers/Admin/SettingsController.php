<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        $settings = WebsiteSetting::orderBy('group')->orderBy('sort_order')->get()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update website settings.
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $oldSettings = [];
        $newSettings = [];

        foreach ($request->all() as $key => $value) {
            if ($key === '_token' || $key === '_method') {
                continue;
            }

            $setting = WebsiteSetting::where('key', $key)->first();
            
            if (!$setting) {
                continue;
            }

            $oldSettings[$key] = $setting->value;

            // Handle file uploads
            if ($setting->type === 'image' && $request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('settings', 'public');
                
                // Delete old file if exists
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }
                
                $value = $path;
            }

            WebsiteSetting::set($key, $value, $setting->type);
            $newSettings[$key] = $value;
        }

        AdminActivityLog::logAction(
            $admin,
            'updated',
            null,
            $oldSettings,
            $newSettings
        );

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Reset settings to default.
     */
    public function reset()
    {
        $admin = Auth::guard('admin')->user();

        // Reset all settings to their default values
        WebsiteSetting::truncate();

        // Re-run the seeder to restore defaults
        \Artisan::call('db:seed', ['--class' => 'WebsiteSettingsSeeder']);

        AdminActivityLog::logAction(
            $admin,
            'reset_settings',
            null,
            null,
            ['action' => 'Reset all settings to defaults']
        );

        return response()->json([
            'success' => true,
            'message' => 'Settings reset to default values successfully.'
        ]);
    }
}
