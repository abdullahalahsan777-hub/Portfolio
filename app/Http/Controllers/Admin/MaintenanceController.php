<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    /**
     * Show Maintenance & System Health Dashboard.
     */
    public function index(): View
    {
        $isDown = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

        // Ensure native artisan down is released so admin login and bypass work cleanly
        if (App::isDownForMaintenance()) {
            Artisan::call('up');
        }

        // Database size check (MySQL / SQLite)
        $dbSize = 'Connected';
        try {
            $connection = config('database.default');
            if ($connection === 'mysql') {
                $dbName = config('database.connections.mysql.database');
                $sizeQuery = DB::select("
                    SELECT table_schema AS `database`, 
                    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS `size_mb` 
                    FROM information_schema.TABLES 
                    WHERE table_schema = ? 
                    GROUP BY table_schema
                ", [$dbName]);
                if (!empty($sizeQuery)) {
                    $dbSize = $sizeQuery[0]->size_mb . ' MB';
                }
            } else {
                $dbPath = database_path('database.sqlite');
                $dbSize = File::exists($dbPath) ? round(File::size($dbPath) / 1024, 2).' KB' : 'N/A';
            }
        } catch (\Throwable $e) {
            $dbSize = 'Active (Connected)';
        }

        // Cache files count
        $frameworkCachePath = storage_path('framework/cache');
        $cacheSize = File::exists($frameworkCachePath) ? count(File::allFiles($frameworkCachePath)).' items' : '0 items';

        // System info
        $systemInfo = [
            'php_version' => PHP_VERSION,
            'laravel_version' => App::version(),
            'app_env' => config('app.env'),
            'app_debug' => config('app.debug') ? 'Enabled (Development)' : 'Disabled (Production)',
            'database_connection' => config('database.default'),
            'database_size' => $dbSize,
            'cache_driver' => config('cache.default'),
            'session_driver' => config('session.driver'),
            'storage_status' => is_writable(storage_path()) ? 'Writable' : 'Read Only',
            'is_maintenance' => $isDown,
            'server_status' => SiteSetting::get('server_status', 'up'),
            'maintenance_title' => SiteSetting::get('maintenance_title', 'System Upgrade in Progress'),
            'maintenance_message' => SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.'),
            'maintenance_estimated_time' => SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes'),
        ];

        $this->data['systemInfo'] = $systemInfo;
        $this->data['isDown'] = $isDown;

        return view('admin.maintenance.index', $this->data);
    }

    /**
     * Clear application cache.
     */
    public function clearCache(Request $request): RedirectResponse
    {
        $type = $request->input('type', 'all');

        try {
            switch ($type) {
                case 'config':
                    Artisan::call('config:clear');
                    $msg = 'Configuration cache cleared successfully.';
                    break;
                case 'routes':
                    Artisan::call('route:clear');
                    $msg = 'Route cache cleared successfully.';
                    break;
                case 'views':
                    Artisan::call('view:clear');
                    $msg = 'Compiled view cache cleared successfully.';
                    break;
                case 'optimize':
                    Artisan::call('optimize:clear');
                    $msg = 'All caches (config, cache, routes, views) cleared and optimized.';
                    break;
                default:
                    Artisan::call('cache:clear');
                    $msg = 'Application data cache cleared successfully.';
                    break;
            }

            \App\Models\Notification::record([
                'user_id' => Auth::id(),
                'type' => 'system',
                'title' => 'System Cache Cleared',
                'message' => $msg,
                'action_url' => route('admin.maintenance.index'),
                'icon' => 'server',
                'color' => 'emerald',
            ]);

            flash()->success($msg);

            return redirect()->back();
        } catch (\Throwable $e) {
            flash()->danger('Failed to clear cache: '.$e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Toggle Maintenance Mode (1-Click Switch).
     */
    public function toggleMaintenance(Request $request): RedirectResponse
    {
        try {
            $currentlyDown = SiteSetting::get('maintenance_mode', '0') === '1'
                || SiteSetting::get('server_status', 'up') === 'maintenance';

            if ($currentlyDown) {
                // UPGRADE SERVER STATUS BACK TO UP / LIVE
                SiteSetting::set('maintenance_mode', '0', 'maintenance');
                SiteSetting::set('server_status', 'up', 'maintenance');
                Artisan::call('optimize:clear');

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Server Status Upgraded to LIVE',
                    'message' => 'The server was upgraded back to LIVE status. Frontend portfolio and client portal are accessible.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'emerald',
                ]);

                flash()->important('🚀 Server Status successfully UPGRADED to LIVE! Frontend and Client User Panel are now accessible to all visitors.');

                return redirect()->back();
            } else {
                // ACTIVATE SERVICE UNAVAILABLE (503) FOR FRONTEND AND USER PANEL
                SiteSetting::set('maintenance_mode', '1', 'maintenance');
                SiteSetting::set('server_status', 'maintenance', 'maintenance');

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Maintenance Mode Enabled (503)',
                    'message' => 'Server placed in scheduled maintenance mode. Visitors will receive HTTP 503 Service Unavailable.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'amber',
                ]);

                flash()->warning('⚠️ Server placed in MAINTENANCE / UPGRADE Mode. Frontend and Client User Panel will return HTTP 503 Service Unavailable. Admin panel remains fully operational.');

                return redirect()->back();
            }
        } catch (\Throwable $e) {
            flash()->danger('Error toggling server status: '.$e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Server Status Upgrade action with custom message and parameters.
     */
    public function upgradeStatus(Request $request): RedirectResponse
    {
        $action = $request->input('action', 'up');

        try {
            if ($action === 'up') {
                SiteSetting::set('maintenance_mode', '0', 'maintenance');
                SiteSetting::set('server_status', 'up', 'maintenance');
                Artisan::call('optimize:clear');

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Server Upgraded to LIVE',
                    'message' => 'System maintenance completed and server status upgraded to LIVE.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'emerald',
                ]);

                flash()->important('🚀 Server Status UPGRADE COMPLETE! The system is now LIVE and accessible to all users.');

                return redirect()->back();
            } else {
                $validated = $request->validate([
                    'title' => 'nullable|string|max:150',
                    'message' => 'nullable|string|max:500',
                    'estimated_time' => 'nullable|string|max:100',
                ]);

                SiteSetting::set('maintenance_mode', '1', 'maintenance');
                SiteSetting::set('server_status', 'maintenance', 'maintenance');

                if (!empty($validated['title'])) {
                    SiteSetting::set('maintenance_title', $validated['title'], 'maintenance');
                }
                if (!empty($validated['message'])) {
                    SiteSetting::set('maintenance_message', $validated['message'], 'maintenance');
                }
                if (!empty($validated['estimated_time'])) {
                    SiteSetting::set('maintenance_estimated_time', $validated['estimated_time'], 'maintenance');
                }

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Maintenance Mode Activated',
                    'message' => 'Custom server upgrade banner and 503 status applied.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'amber',
                ]);

                flash()->warning('⚠️ Server status set to MAINTENANCE / UPGRADE MODE. Frontend and Client Dashboard are serving 503 Service Unavailable.');

                return redirect()->back();
            }
        } catch (\Throwable $e) {
            flash()->danger('Failed to update server status: '.$e->getMessage());

            return redirect()->back();
        }
    }
}
