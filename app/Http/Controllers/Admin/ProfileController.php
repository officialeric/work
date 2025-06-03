<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the admin profile page.
     */
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        $recentActivities = AdminActivityLog::where('admin_id', $admin->id)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.profile.show', compact('admin', 'recentActivities'));
    }

    /**
     * Update the admin profile.
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $oldData = $admin->only(['name', 'email']);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        AdminActivityLog::logAction(
            $admin,
            'updated_profile',
            $admin,
            $oldData,
            $admin->only(['name', 'email'])
        );

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required|current_password:admin',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        AdminActivityLog::logAction(
            $admin,
            'changed_password',
            $admin
        );

        return redirect()->route('admin.profile.show')
            ->with('success', 'Password updated successfully.');
    }

    /**
     * Show the admin profile edit form.
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        
        return view('admin.profile.edit', compact('admin'));
    }
}
