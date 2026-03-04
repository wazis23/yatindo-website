<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('settings')) {

    function settings($key)
    {
        return cache()->rememberForever('settings', function () {
            return \App\Models\Setting::first();
        })->$key ?? null;
    }
}