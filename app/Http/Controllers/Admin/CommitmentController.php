<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commitment;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommitmentController extends Controller
{
    /**
     * Display a listing of commitments.
     */
    public function index()
    {
        $commitments = Commitment::ordered()->get();
        
        return view('admin.commitments.index', compact('commitments'));
    }

    /**
     * Show the form for creating a new commitment.
     */
    public function create()
    {
        return view('admin.commitments.create');
    }

    /**
     * Store a newly created commitment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'icon', 'sort_order', 'is_active']);
        $data['is_active'] = $request->boolean('is_active');

        $commitment = Commitment::create($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'created',
            $commitment,
            null,
            $commitment->toArray()
        );

        return redirect()->route('admin.commitments.index')
            ->with('success', 'Commitment created successfully.');
    }

    /**
     * Show the form for editing a commitment.
     */
    public function edit(Commitment $commitment)
    {
        return view('admin.commitments.edit', compact('commitment'));
    }

    /**
     * Update the specified commitment.
     */
    public function update(Request $request, Commitment $commitment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $oldData = $commitment->toArray();
        $data = $request->only(['title', 'icon', 'sort_order', 'is_active']);
        $data['is_active'] = $request->boolean('is_active');

        $commitment->update($data);

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'updated',
            $commitment,
            $oldData,
            $commitment->fresh()->toArray()
        );

        return redirect()->route('admin.commitments.index')
            ->with('success', 'Commitment updated successfully.');
    }

    /**
     * Remove the specified commitment.
     */
    public function destroy(Commitment $commitment)
    {
        $oldData = $commitment->toArray();
        
        $commitment->delete();

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'deleted',
            null,
            $oldData,
            null
        );

        return redirect()->route('admin.commitments.index')
            ->with('success', 'Commitment deleted successfully.');
    }

    /**
     * Update commitments order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'commitments' => 'required|array',
            'commitments.*.id' => 'required|exists:commitments,id',
            'commitments.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->commitments as $commitmentData) {
            Commitment::where('id', $commitmentData['id'])
                ->update(['sort_order' => $commitmentData['sort_order']]);
        }

        AdminActivityLog::logAction(
            Auth::guard('admin')->user(),
            'reordered',
            null,
            null,
            ['commitments' => $request->commitments]
        );

        return response()->json(['success' => true]);
    }
}
