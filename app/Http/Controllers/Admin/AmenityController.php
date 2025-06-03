<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmenityController extends Controller
{
    /**
     * Display a listing of amenities.
     */
    public function index()
    {
        $amenities = Amenity::ordered()->get();
        
        return view('admin.amenities.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new amenity.
     */
    public function create()
    {
        return view('admin.amenities.create');
    }

    /**
     * Store a newly created amenity.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'subtitle', 'icon', 'sort_order', 'is_active']);
        $data['is_active'] = $request->boolean('is_active');

        $amenity = Amenity::create($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'created',
            $amenity,
            null,
            $amenity->toArray()
        );

        return redirect()->route('admin.amenities.index')
            ->with('success', 'Amenity created successfully.');
    }

    /**
     * Show the form for editing an amenity.
     */
    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified amenity.
     */
    public function update(Request $request, Amenity $amenity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'icon' => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $oldData = $amenity->toArray();
        $data = $request->only(['title', 'subtitle', 'icon', 'sort_order', 'is_active']);
        $data['is_active'] = $request->boolean('is_active');

        $amenity->update($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $amenity,
            $oldData,
            $amenity->fresh()->toArray()
        );

        return redirect()->route('admin.amenities.index')
            ->with('success', 'Amenity updated successfully.');
    }

    /**
     * Remove the specified amenity.
     */
    public function destroy(Amenity $amenity)
    {
        $oldData = $amenity->toArray();
        
        $amenity->delete();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            null,
            $oldData,
            null
        );

        return redirect()->route('admin.amenities.index')
            ->with('success', 'Amenity deleted successfully.');
    }

    /**
     * Update amenities order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'amenities' => 'required|array',
            'amenities.*.id' => 'required|exists:amenities,id',
            'amenities.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->amenities as $amenityData) {
            Amenity::where('id', $amenityData['id'])
                ->update(['sort_order' => $amenityData['sort_order']]);
        }

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'reordered',
            null,
            null,
            ['amenities' => $request->amenities]
        );

        return response()->json(['success' => true]);
    }
}
