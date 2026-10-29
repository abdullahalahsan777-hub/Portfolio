<?php

namespace App\Providers;

use App\Services\NotificationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
    }
}
