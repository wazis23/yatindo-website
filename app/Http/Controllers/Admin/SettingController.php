<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

            'logo_admin' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ]);

        $manager = new ImageManager(new Driver());

        /*
        |--------------------------------
        | LOGO ADMIN
        |--------------------------------
        */

        if ($request->hasFile('logo_admin')) {

            if ($setting->logo_admin) {
                Storage::disk('public')->delete($setting->logo_admin);
            }

            $image = $request->file('logo_admin');

            $img = $manager->read($image)
                ->resize(300, null)
                ->toWebp(80);

            $filename = 'logo_admin_' . time() . '.webp';

            Storage::disk('public')
                ->put('logos/' . $filename, $img);

            $setting->logo_admin = 'logos/' . $filename;
        }

        /*
        |--------------------------------
        | FAVICON
        |--------------------------------
        */

        if ($request->hasFile('favicon')) {

            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $image = $request->file('favicon');

            $img = $manager->read($image)
                ->cover(64, 64)
                ->toPng();

            $filename = 'favicon.png';

            Storage::disk('public')
                ->put('logos/' . $filename, $img);

            $setting->favicon = 'logos/' . $filename;
        }

        $setting->fill($request->except([
            'logo_admin',
            'favicon'
        ]));

        $setting->maintenance_mode = $request->has('maintenance_mode');

        $setting->save();

        cache()->forget('settings');

        return back()->with('success','Pengaturan berhasil diperbarui');
    }
}