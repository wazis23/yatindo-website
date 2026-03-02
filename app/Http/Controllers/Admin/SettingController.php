<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate([]);

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate([]);

        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'logo_frontend' => 'nullable|image',
            'logo_admin' => 'nullable|image',
            'favicon' => 'nullable|image',
        ]);

        // Replace Logo Frontend
        if ($request->hasFile('logo_frontend')) {
            if ($setting->logo_frontend) {
                Storage::disk('public')->delete($setting->logo_frontend);
            }

            $setting->logo_frontend =
                $request->file('logo_frontend')->store('logos','public');
        }

        // Replace Logo Admin
        if ($request->hasFile('logo_admin')) {
            if ($setting->logo_admin) {
                Storage::disk('public')->delete($setting->logo_admin);
            }

            $setting->logo_admin =
                $request->file('logo_admin')->store('logos','public');
        }

        // Replace Favicon
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $setting->favicon =
                $request->file('favicon')->store('logos','public');
        }

        // Fill text
        $setting->fill($request->except([
            'logo_frontend',
            'logo_admin',
            'favicon'
        ]));

        $setting->maintenance_mode = $request->has('maintenance_mode');

        $setting->save();

        cache()->forget('settings');

        return back()->with('success','Pengaturan berhasil diperbarui');
    }
}