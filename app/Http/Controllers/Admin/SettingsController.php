<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the settings edit form
     */
    public function edit()
    {
        $settings = SystemSetting::current();
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update the system settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'application_start_date' => 'nullable|date_format:Y-m-d\TH:i',
            'application_end_date' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        // Additional validation: end date must be after start date if both are provided
        if ($validated['application_start_date'] && $validated['application_end_date']) {
            if ($validated['application_end_date'] <= $validated['application_start_date']) {
                return back()
                    ->withErrors(['application_end_date' => 'End date must be after the start date.'])
                    ->withInput();
            }
        }

        $settings = SystemSetting::current();
        $settings->update($validated);

        return back()->with('success', 'Application period updated successfully.');
    }
}
