<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Notification;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the main admin dashboard with full-spectrum reporting.
     */
    public function index(): View
    {
        // 1. Inquiries & Client Communications Metrics
        $totalMessages    = ContactMessage::count();
        $unreadMessages   = ContactMessage::where('is_read', false)->count();
        $readMessages     = $totalMessages - $unreadMessages;
        $readPercentage   = $totalMessages > 0 ? round(($readMessages / $totalMessages) * 100, 1) : 100;

        // 2. Content & Resource Subsystems Telemetry
        $totalProjects      = Project::count();
        $featuredProjects   = Project::where('is_featured', true)->count();

        $totalArticles       = BlogPost::count();
        $publishedArticles   = BlogPost::where('is_published', true)->count();
        $draftArticles       = BlogPost::where('is_published', false)->count();

        $totalServices       = Service::count();
        $totalSkills         = Skill::count();
        $avgSkillLevel       = round((float) (Skill::avg('percentage') ?? 0));

        $totalResume         = ResumeItem::count();
        $experienceCount     = ResumeItem::where('type', 'experience')->count();
        $educationCount      = ResumeItem::where('type', 'education')->count();

        $totalPricingPlans   = PricingPlan::count();
        $featuredPricingPlans= PricingPlan::where('is_featured', true)->count();

        $totalTestimonials     = Testimonial::count();
        $topRatingTestimonials = Testimonial::where('rating', '>=', 5)->count();

        $totalFaqs             = Faq::count();

        // Total platform content assets count
        $totalContentAssets    = $totalProjects + $totalArticles + $totalServices + $totalSkills + $totalResume + $totalPricingPlans + $totalTestimonials + $totalFaqs;

        // 3. User Accounts & Access Telemetry
        $totalUsers            = User::count();
        $adminUsers            = User::where('role', 'admin')->count();
        $clientUsers           = User::where('role', '!=', 'admin')->count();
        $socialUsers           = User::whereNotNull('provider')->count();

        // 4. Notifications & Operational Activity Telemetry
        $currentUser           = Auth::user();
        $notifQuery            = Notification::forUser($currentUser);
        $totalNotifications    = (clone $notifQuery)->count();
        $unreadNotifications   = (clone $notifQuery)->unread()->count();
        $readNotifications     = $totalNotifications - $unreadNotifications;
        $todayNotifications    = (clone $notifQuery)->whereDate('created_at', today())->count();
        $notifReadPercentage   = $totalNotifications > 0 ? round(($readNotifications / $totalNotifications) * 100, 1) : 100;

        // 5. Server & System Environment Status
        $isDown = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

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
                if (!empty($sizeQuery) && isset($sizeQuery[0]->size_mb)) {
                    $dbSize = $sizeQuery[0]->size_mb . ' MB';
                }
            } else {
                $dbPath = database_path('database.sqlite');
                $dbSize = File::exists($dbPath) ? round(File::size($dbPath) / 1024, 2) . ' KB' : 'Active';
            }
        } catch (\Throwable $e) {
            $dbSize = 'Active';
        }

        $stats = [
            // Platform appearance & server state
            'active_theme'      => SiteSetting::get('active_theme', 'developer'),
            'theme_mode'        => SiteSetting::get('theme_mode', 'dark'),
            'is_maintenance'    => $isDown,
            'server_status'     => SiteSetting::get('server_status', 'up'),

            // Server telemetry
            'php_version'       => PHP_VERSION,
            'laravel_version'   => App::version(),
            'app_env'           => config('app.env'),
            'app_debug'         => config('app.debug') ? 'Enabled' : 'Disabled',
            'db_connection'     => config('database.default'),
            'db_size'           => $dbSize,
            'cache_driver'      => config('cache.default'),
            'storage_status'    => is_writable(storage_path()) ? 'Writable' : 'Read Only',

            // Inquiries & Client telemetry
            'total_messages'    => $totalMessages,
            'unread_messages'   => $unreadMessages,
            'read_messages'     => $readMessages,
            'read_percentage'   => $readPercentage,

            // Content subsystems
            'total_content_assets' => $totalContentAssets,
            'total_projects'       => $totalProjects,
            'featured_projects'    => $featuredProjects,
            'total_articles'       => $totalArticles,
            'published_articles'   => $publishedArticles,
            'draft_articles'       => $draftArticles,
            'total_services'       => $totalServices,
            'total_skills'         => $totalSkills,
            'avg_skill_level'      => $avgSkillLevel,
            'total_resume'         => $totalResume,
            'experience_count'     => $experienceCount,
            'education_count'      => $educationCount,
            'total_pricing_plans'  => $totalPricingPlans,
            'featured_pricing_plans' => $featuredPricingPlans,
            'total_testimonials'   => $totalTestimonials,
            'top_rating_testimonials' => $topRatingTestimonials,
            'total_faqs'           => $totalFaqs,

            // Users telemetry
            'total_users'          => $totalUsers,
            'admin_users'          => $adminUsers,
            'client_users'         => $clientUsers,
            'social_users'         => $socialUsers,

            // Notifications telemetry
            'total_notifications'   => $totalNotifications,
            'unread_notifications'  => $unreadNotifications,
            'read_notifications'    => $readNotifications,
            'today_notifications'   => $todayNotifications,
            'notification_read_percentage' => $notifReadPercentage,
        ];

        // 6. Streams & Activity
        $recentMessages        = ContactMessage::latest()->take(6)->get();
        $recentProjects        = Project::latest()->take(5)->get();
        $recentArticles        = BlogPost::latest()->take(6)->get();
        $recentUsers           = User::latest()->take(5)->get();
        $recentNotifications   = (clone $notifQuery)->latest()->take(6)->get();

        $this->data['stats']               = $stats;
        $this->data['recentMessages']      = $recentMessages;
        $this->data['recentProjects']      = $recentProjects;
        $this->data['recentArticles']      = $recentArticles;
        $this->data['recentUsers']         = $recentUsers;
        $this->data['recentNotifications'] = $recentNotifications;

        return view('admin.dashboard', $this->data);
    }
}

