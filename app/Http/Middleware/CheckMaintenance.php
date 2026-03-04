<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;

class CheckMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first();

        if ($setting && $setting->maintenance_mode) {

            // Izinkan halaman maintenance
            if ($request->is('maintenance')) {
                return $next($request);
            }

            // Izinkan admin panel tetap diakses
            if ($request->is('admin') || $request->is('admin/*')) {
                return $next($request);
            }

            // Redirect ke halaman maintenance
            return redirect('/maintenance');
        }

        return $next($request);
    }
}