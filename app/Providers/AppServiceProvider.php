<?php

namespace App\Providers;

use App\Models\Subscriber;
use App\Services\NotificationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (!class_exists('SiteSetting', false)) {
            class_alias(SiteSetting::class, 'SiteSetting');
        }

        $helperPath = app_path('Helpers/Helper.php');
        if (file_exists($helperPath)) {
            require_once $helperPath;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        NotificationService::registerListeners();

        // Synchronize application root URL and port dynamically with .env SERVER_PORT
        $serverPort = env('SERVER_PORT');
        if (!empty($serverPort) && !app()->runningUnitTests()) {
            $configuredUrl = config('app.url', 'http://127.0.0.1');
            if (!str_contains($configuredUrl, ':' . $serverPort) && !str_starts_with($configuredUrl, 'https://')) {
                $parsed = parse_url($configuredUrl);
                $scheme = $parsed['scheme'] ?? 'http';
                $host = $parsed['host'] ?? '127.0.0.1';
                URL::forceRootUrl("{$scheme}://{$host}:{$serverPort}");
            }
        }

        // Synchronize application root URL and port dynamically with .env SERVER_PORT
        $serverPort = env('SERVER_PORT');
        if (!empty($serverPort) && !app()->runningUnitTests()) {
            $configuredUrl = config('app.url', 'http://127.0.0.1');
            if (!str_contains($configuredUrl, ':' . $serverPort) && !str_starts_with($configuredUrl, 'https://')) {
                $parsed = parse_url($configuredUrl);
                $scheme = $parsed['scheme'] ?? 'http';
                $host = $parsed['host'] ?? '127.0.0.1';
                \Illuminate\Support\Facades\URL::forceRootUrl("{$scheme}://{$host}:{$serverPort}");
            }
        }

        // Share newsletter subscriber count across all frontend views and theme footers
        View::composer('frontend.*', function ($view) {
            $count = Subscriber::where('status', 'active')->count();
            $view->with('subscribersCount', $count);
        });
    }
}
