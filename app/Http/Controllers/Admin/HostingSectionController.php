<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HostingSection;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HostingSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostingSections = HostingSection::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.hosting-sections.index', compact('hostingSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hosting-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'video_button_text' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('hosting-sections', 'public');
        }

        $hostingSection = HostingSection::create($data);

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'created',
            $hostingSection,
            null,
            $hostingSection->toArray()
        );

        return redirect()->route('admin.hosting-sections.index')
            ->with('success', 'Hosting section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HostingSection $hostingSection)
    {
        return view('admin.hosting-sections.show', compact('hostingSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HostingSection $hostingSection)
    {
        return view('admin.hosting-sections.edit', compact('hostingSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HostingSection $hostingSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'video_button_text' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($hostingSection->background_image && !str_starts_with($hostingSection->background_image, 'http')) {
                Storage::disk('public')->delete($hostingSection->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('hosting-sections', 'public');
        }

        $hostingSection->update($data);

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $hostingSection,
            $oldData,
            $hostingSection->fresh()->toArray()
        );

        return redirect()->route('admin.hosting-sections.index')
            ->with('success', 'Hosting section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HostingSection $hostingSection)
    {
        $oldData = $hostingSection->toArray();

        // Delete associated background image
        if ($hostingSection->background_image && !str_starts_with($hostingSection->background_image, 'http')) {
            Storage::disk('public')->delete($hostingSection->background_image);
        }

        $hostingSection->delete();

        // Log activity
        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            null,
            $oldData,
            null
        );

        return redirect()->route('admin.hosting-sections.index')
            ->with('success', 'Hosting section deleted successfully.');
    }
}
