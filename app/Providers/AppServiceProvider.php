<?php

namespace App\Providers;

use App\Models\Subscriber;
use App\Services\NotificationService;
use Illuminate\Support\Facades\View;
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

        // Share newsletter subscriber count across all frontend views and theme footers
        View::composer('frontend.*', function ($view) {
            $count = Subscriber::where('status', 'active')->count();
            $view->with('subscribersCount', $count);
        });
    }
}
