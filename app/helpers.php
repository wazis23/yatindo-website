<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('settings')) {

    function settings($key = null)
    {
        $settings = Cache::rememberForever('settings_cache', function () {
            return Setting::first();
        });

        if (!$settings) {
            return null;
        }

        if ($key) {
            return $settings->$key ?? null;
        }

        return $settings;
    }
}