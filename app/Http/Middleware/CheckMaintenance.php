<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next)
    {
        $setting = \App\Models\Setting::first();

        if ($setting && $setting->maintenance_mode && !auth()->check()) {
            return response()->view('maintenance');
        }

        return $next($request);
    }
}
