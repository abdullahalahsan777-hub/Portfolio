<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ServerDownMail;
use App\Mail\ServerUpMail;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            'registered_users_count' => User::whereNotNull('email')->count(),
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
            $shouldSendEmail = $request->boolean('send_email', true);

            if ($currentlyDown) {
                // UPGRADE SERVER STATUS BACK TO UP / LIVE
                SiteSetting::set('maintenance_mode', '0', 'maintenance');
                SiteSetting::set('server_status', 'up', 'maintenance');
                Artisan::call('optimize:clear');

                $emailSummary = '';
                if ($shouldSendEmail) {
                    $stats = $this->broadcastStatusEmail('up');
                    $emailSummary = " &bull; 📧 Live notification sent to {$stats['sent']}/{$stats['total']} user(s).";
                }

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Server Status Upgraded to LIVE',
                    'message' => 'The server was upgraded back to LIVE status. Frontend portfolio and client portal are accessible.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'emerald',
                ]);

                flash()->important("🚀 Server Status successfully UPGRADED to LIVE! Frontend and Client User Panel are accessible.{$emailSummary}");

                return redirect()->back();
            } else {
                // ACTIVATE SERVICE UNAVAILABLE (503) FOR FRONTEND AND USER PANEL
                SiteSetting::set('maintenance_mode', '1', 'maintenance');
                SiteSetting::set('server_status', 'maintenance', 'maintenance');

                $emailSummary = '';
                if ($shouldSendEmail) {
                    $stats = $this->broadcastStatusEmail('down');
                    $emailSummary = " &bull; 📧 503 notification sent to {$stats['sent']}/{$stats['total']} user(s).";
                }

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Maintenance Mode Enabled (503)',
                    'message' => 'Server placed in scheduled maintenance mode. Visitors will receive HTTP 503 Service Unavailable.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'amber',
                ]);

                flash()->warning("⚠️ Server placed in MAINTENANCE / UPGRADE Mode (HTTP 503). Admin panel remains fully operational.{$emailSummary}");

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
        $shouldSendEmail = $request->boolean('send_email', true);

        try {
            if ($action === 'up') {
                SiteSetting::set('maintenance_mode', '0', 'maintenance');
                SiteSetting::set('server_status', 'up', 'maintenance');
                Artisan::call('optimize:clear');

                $emailSummary = '';
                if ($shouldSendEmail) {
                    $stats = $this->broadcastStatusEmail('up');
                    $emailSummary = " &bull; 📧 Live notification sent to {$stats['sent']}/{$stats['total']} user(s).";
                }

                \App\Models\Notification::record([
                    'user_id' => Auth::id(),
                    'type' => 'system',
                    'title' => 'Server Upgraded to LIVE',
                    'message' => 'System maintenance completed and server status upgraded to LIVE.',
                    'action_url' => route('admin.maintenance.index'),
                    'icon' => 'server',
                    'color' => 'emerald',
                ]);

                flash()->important("🚀 Server Status UPGRADE COMPLETE! The system is now LIVE and accessible to all users.{$emailSummary}");

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

                $emailSummary = '';
                if ($shouldSendEmail) {
                    $stats = $this->broadcastStatusEmail('down', [
                        'title' => $validated['title'] ?? null,
                        'noticeMessage' => $validated['message'] ?? null,
                        'estimatedTime' => $validated['estimated_time'] ?? null,
                    ]);
                    $emailSummary = " &bull; 📧 503 notification sent to {$stats['sent']}/{$stats['total']} user(s).";
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

                flash()->warning("⚠️ Server status set to MAINTENANCE / UPGRADE MODE (HTTP 503).{$emailSummary}");

                return redirect()->back();
            }
        } catch (\Throwable $e) {
            flash()->danger('Failed to update server status: '.$e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Broadcast Server Status Email (Down or Up) to all registered users.
     */
    protected function broadcastStatusEmail(string $status, array $customDetails = []): array
    {
        $users = User::whereNotNull('email')->get();
        $sent = 0;
        $failed = 0;
        $errors = [];

        $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
        $contactEmail = SiteSetting::get('contact_email', config('mail.from.address', 'support@portfolio.local'));

        foreach ($users as $user) {
            try {
                if ($status === 'down') {
                    $details = array_merge([
                        'siteName' => $siteName,
                        'title' => SiteSetting::get('maintenance_title', 'System Upgrade in Progress'),
                        'noticeMessage' => SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.'),
                        'estimatedTime' => SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes'),
                        'startedAt' => now()->format('M d, Y • h:i A T'),
                        'statusUrl' => url('/errors/503'),
                        'contactEmail' => $contactEmail,
                    ], array_filter($customDetails));

                    Mail::to($user->email)->send(new ServerDownMail($user, $details));
                } else {
                    $details = array_merge([
                        'siteName' => $siteName,
                        'title' => 'System Restored & Live Online',
                        'noticeMessage' => 'All frontend portfolio themes, user dashboards, and application services are back online and operating normally at peak performance. Thank you for your patience while we upgraded our infrastructure!',
                        'restoredAt' => now()->format('M d, Y • h:i A T'),
                        'dashboardUrl' => route('login'),
                        'contactEmail' => $contactEmail,
                    ], array_filter($customDetails));

                    Mail::to($user->email)->send(new ServerUpMail($user, $details));
                }
                $sent++;
            } catch (\Throwable $e) {
                $failed++;
                $errors[] = $e->getMessage();
                Log::warning("Failed to broadcast server {$status} email to [{$user->email}]: " . $e->getMessage());
            }
        }

        return [
            'sent' => $sent,
            'failed' => $failed,
            'total' => $users->count(),
            'errors' => $errors,
        ];
    }

    /**
     * Preview Server Down or Server Up Email in the browser.
     */
    public function previewEmail(Request $request)
    {
        $type = $request->query('type', 'down');
        $user = Auth::user() ?? User::first() ?? new User(['name' => 'Demo User', 'email' => 'user@example.com']);

        $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
        $contactEmail = SiteSetting::get('contact_email', config('mail.from.address', 'support@portfolio.local'));

        if ($type === 'up') {
            $mail = new ServerUpMail($user, [
                'siteName' => $siteName,
                'title' => 'System Restored & Live Online',
                'noticeMessage' => 'All frontend portfolio themes, user dashboards, and application services are back online and operating normally at peak performance. Thank you for your patience while we upgraded our infrastructure!',
                'restoredAt' => now()->format('M d, Y • h:i A T'),
                'dashboardUrl' => route('login'),
                'contactEmail' => $contactEmail,
            ]);
        } else {
            $mail = new ServerDownMail($user, [
                'siteName' => $siteName,
                'title' => SiteSetting::get('maintenance_title', 'System Upgrade in Progress'),
                'noticeMessage' => SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.'),
                'estimatedTime' => SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes'),
                'startedAt' => now()->format('M d, Y • h:i A T'),
                'statusUrl' => url('/errors/503'),
                'contactEmail' => $contactEmail,
            ]);
        }

        return $mail->render();
    }

    /**
     * Send a sample test email to the logged-in administrator.
     */
    public function sendTestEmail(Request $request): RedirectResponse
    {
        $type = $request->input('type', 'down');
        $admin = Auth::user();

        if (!$admin || empty($admin->email)) {
            flash()->danger('Admin account does not have a valid email configured.');
            return redirect()->back();
        }

        $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
        $contactEmail = SiteSetting::get('contact_email', config('mail.from.address', 'support@portfolio.local'));

        try {
            if ($type === 'up') {
                Mail::to($admin->email)->send(new ServerUpMail($admin, [
                    'siteName' => $siteName,
                    'title' => 'System Restored & Live Online (Test)',
                    'noticeMessage' => 'All frontend portfolio themes, user dashboards, and application services are back online and operating normally at peak performance. This is a test dispatch.',
                    'restoredAt' => now()->format('M d, Y • h:i A T'),
                    'dashboardUrl' => route('login'),
                    'contactEmail' => $contactEmail,
                ]));
                flash()->success("🚀 Test 'Server UP' notification dispatched to {$admin->email}.");
            } else {
                Mail::to($admin->email)->send(new ServerDownMail($admin, [
                    'siteName' => $siteName,
                    'title' => SiteSetting::get('maintenance_title', 'System Upgrade in Progress') . ' (Test)',
                    'noticeMessage' => SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. This is a test dispatch.'),
                    'estimatedTime' => SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes'),
                    'startedAt' => now()->format('M d, Y • h:i A T'),
                    'statusUrl' => url('/errors/503'),
                    'contactEmail' => $contactEmail,
                ]));
                flash()->warning("⚠️ Test 'Server DOWN (503)' notification dispatched to {$admin->email}.");
            }
        } catch (\Throwable $e) {
            flash()->danger("Failed to dispatch test email: " . $e->getMessage());
        }

        return redirect()->back();
    }
}
