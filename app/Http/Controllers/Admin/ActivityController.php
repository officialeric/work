<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities.
     */
    public function index()
    {
        $activities = Activity::ordered()->get();
        
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created activity.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'number' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'description', 'number', 'sort_order', 'is_active']);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('activities', 'public');
        }

        $activity = Activity::create($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'created',
            $activity,
            null,
            $activity->toArray()
        );

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity created successfully.');
    }

    /**
     * Show the form for editing an activity.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified activity.
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'number' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $oldData = $activity->toArray();
        $data = $request->only(['title', 'description', 'number', 'sort_order', 'is_active']);
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($activity->image && !str_starts_with($activity->image, 'http')) {
                Storage::disk('public')->delete($activity->image);
            }
            
            $data['image'] = $request->file('image')->store('activities', 'public');
        }

        $activity->update($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $activity,
            $oldData,
            $activity->fresh()->toArray()
        );

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified activity.
     */
    public function destroy(Activity $activity)
    {
        $oldData = $activity->toArray();
        
        $activity->delete();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            null,
            $oldData,
            null
        );

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully.');
    }

    /**
     * Update activities order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'activities' => 'required|array',
            'activities.*.id' => 'required|exists:activities,id',
            'activities.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->activities as $activityData) {
            Activity::where('id', $activityData['id'])
                ->update(['sort_order' => $activityData['sort_order']]);
        }

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'reordered',
            null,
            null,
            ['activities' => $request->activities]
        );

        return response()->json(['success' => true]);
    }
}
