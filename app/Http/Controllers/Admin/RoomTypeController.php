<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::ordered()->get();
        return view('admin.room-types.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'tent_type' => 'required|string|max:255',
            'tent_quantity' => 'required|integer|min:1',
            'max_occupancy' => 'nullable|integer|min:1',
            'features' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->only([
            'name', 'description', 'price', 'currency', 'tent_type', 
            'tent_quantity', 'max_occupancy', 'sort_order'
        ]);
        
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        
        // Convert features to array if provided
        if ($request->filled('features')) {
            $features = array_filter(array_map('trim', explode("\n", $request->features)));
            $data['features'] = $features;
        }

        // Handle image uploads
        foreach (['main_image', 'image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $data[$imageField] = $request->file($imageField)->store('room-types', 'public');
            }
        }

        $roomType = RoomType::create($data);

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'created',
            $roomType,
            null,
            $roomType->toArray()
        );

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Room type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        return view('admin.room-types.show', compact('roomType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'tent_type' => 'required|string|max:255',
            'tent_quantity' => 'required|integer|min:1',
            'max_occupancy' => 'nullable|integer|min:1',
            'features' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $oldData = $roomType->toArray();
        
        $data = $request->only([
            'name', 'description', 'price', 'currency', 'tent_type', 
            'tent_quantity', 'max_occupancy', 'sort_order'
        ]);
        
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        
        // Convert features to array if provided
        if ($request->filled('features')) {
            $features = array_filter(array_map('trim', explode("\n", $request->features)));
            $data['features'] = $features;
        } else {
            $data['features'] = null;
        }

        // Handle image uploads
        foreach (['main_image', 'image_1', 'image_2', 'image_3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete old image if exists
                if ($roomType->$imageField && !str_starts_with($roomType->$imageField, 'http')) {
                    Storage::disk('public')->delete($roomType->$imageField);
                }
                $data[$imageField] = $request->file($imageField)->store('room-types', 'public');
            }
        }

        $roomType->update($data);

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $roomType,
            $oldData,
            $roomType->toArray()
        );

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Room type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $oldData = $roomType->toArray();
        
        $roomType->delete();

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            $roomType,
            $oldData,
            null
        );

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Room type deleted successfully.');
    }

    /**
     * Update the order of room types
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:room_types,id',
            'items.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            RoomType::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}
