<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name'  => Setting::get('site_name', 'SadafPack Admin'),
            'site_logo'  => Setting::get('site_logo'),
            'site_email' => Setting::get('site_email'),
            'site_phone' => Setting::get('site_phone'),
            'site_address' => Setting::get('site_address'),
        ];

        return view('admin.settings.general', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:255',
            'site_email'   => 'nullable|email',
            'site_phone'   => 'nullable|string|max:20',
            'site_address' => 'nullable|string|max:500',
            'site_logo'    => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        Setting::set('site_name',    $request->site_name);
        Setting::set('site_email',   $request->site_email);
        Setting::set('site_phone',   $request->site_phone);
        Setting::set('site_address', $request->site_address);

        if ($request->hasFile('site_logo')) {
            // Delete old logo
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'Settings updated successfully.');
    }
}