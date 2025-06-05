<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationSection;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccommodationSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodationSections = AccommodationSection::ordered()->get();
        return view('admin.accommodation-sections.index', compact('accommodationSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accommodation-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'description', 'sort_order']);
        $data['is_active'] = $request->boolean('is_active');

        // Handle image uploads
        foreach (['main_image', 'image_1', 'image_2'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $data[$imageField] = $request->file($imageField)->store('accommodation-sections', 'public');
            }
        }

        $accommodationSection = AccommodationSection::create($data);

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'created',
            $accommodationSection,
            null,
            $accommodationSection->toArray()
        );

        return redirect()->route('admin.accommodation-sections.index')
            ->with('success', 'Accommodation section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccommodationSection $accommodationSection)
    {
        return view('admin.accommodation-sections.show', compact('accommodationSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationSection $accommodationSection)
    {
        return view('admin.accommodation-sections.edit', compact('accommodationSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccommodationSection $accommodationSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $oldData = $accommodationSection->toArray();
        $data = $request->only(['title', 'description', 'sort_order']);
        $data['is_active'] = $request->boolean('is_active');

        // Handle image uploads
        foreach (['main_image', 'image_1', 'image_2'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete old image if exists
                if ($accommodationSection->$imageField && !str_starts_with($accommodationSection->$imageField, 'http')) {
                    Storage::disk('public')->delete($accommodationSection->$imageField);
                }
                $data[$imageField] = $request->file($imageField)->store('accommodation-sections', 'public');
            }
        }

        $accommodationSection->update($data);

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $accommodationSection,
            $oldData,
            $accommodationSection->fresh()->toArray()
        );

        return redirect()->route('admin.accommodation-sections.index')
            ->with('success', 'Accommodation section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationSection $accommodationSection)
    {
        $oldData = $accommodationSection->toArray();

        $accommodationSection->delete();

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            null,
            $oldData,
            null
        );

        return redirect()->route('admin.accommodation-sections.index')
            ->with('success', 'Accommodation section deleted successfully.');
    }

    /**
     * Update accommodation sections order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'accommodation_sections' => 'required|array',
            'accommodation_sections.*.id' => 'required|exists:accommodation_sections,id',
            'accommodation_sections.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->accommodation_sections as $sectionData) {
            AccommodationSection::where('id', $sectionData['id'])
                ->update(['sort_order' => $sectionData['sort_order']]);
        }

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'reordered',
            null,
            null,
            ['accommodation_sections' => $request->accommodation_sections]
        );

        return response()->json(['success' => true]);
    }
}
