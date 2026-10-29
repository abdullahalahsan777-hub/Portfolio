<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     * Enforces Service Unavailable (503) for the public frontend and user dashboard
     * while allowing administrators to log in and manage the server from the Admin Panel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isMaintenance = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

        if (! $isMaintenance) {
            return $next($request);
        }

        // Allow admin and authentication endpoints
        if (
            $request->is('admin') ||
            $request->is('admin/*') ||
            $request->is('login') ||
            $request->is('login/*') ||
            $request->is('logout') ||
            $request->is('up') ||
            $request->is('build/*') ||
            $request->is('images/*') ||
            $request->is('assets/*') ||
            $request->is('storage/*') ||
            $request->is('favicon.ico') ||
            $request->is('@vite/*') ||
            $request->is('__vite_ping')
        ) {
            return $next($request);
        }

        // Allow authenticated admin preview with ?preview=1
        if ($request->has('preview') && Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Return 503 maintenance page for public frontend
        $title = SiteSetting::get('maintenance_title', 'System Upgrade in Progress');
        $message = SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.');
        $estimatedTime = SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes');
        $contactEmail = SiteSetting::get('contact_email', 'admin@portfolio.local');

        return response()->view('errors.503', compact('title', 'message', 'estimatedTime', 'contactEmail'), 503, [
            'Retry-After' => '1800',
        ]);
    }
}
