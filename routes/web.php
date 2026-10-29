<?php

use App\Http\Controllers\Admin\BlogPostController as AdminBlogController;
use App\Http\Controllers\Admin\ContactMessageController as AdminMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\MaintenanceController as AdminMaintenanceController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\PricingPlanController as AdminPricingController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ResumeController as AdminResumeController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WebsiteContentController as AdminWebsiteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\PortfolioController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Frontend Routes
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/portfolio', [PortfolioController::class, 'portfolio'])->name('portfolio');
Route::get('/blog', [PortfolioController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PortfolioController::class, 'blogDetail'])->name('blog.detail');
Route::get('/faq', [PortfolioController::class, 'faq'])->name('faq');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact', [PortfolioController::class, 'submitContact'])->name('contact.submit');
Route::get('/download-cv', [PortfolioController::class, 'downloadCv'])->name('cv.download');

// Legacy Route Aliases
Route::get('/projects', [PortfolioController::class, 'portfolio'])->name('project');
Route::get('/services', [PortfolioController::class, 'index'])->name('service');
Route::get('/resume', [PortfolioController::class, 'index'])->name('resume');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // Social Authentication (Google & Facebook)
    Route::get('/auth/{provider}', [AuthController::class, 'redirectToProvider'])->name('auth.social');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('auth.social.callback');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Frontend User Dashboard
Route::middleware(['auth'])->prefix('dashboard')->name('user.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
    Route::post('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password', [UserDashboardController::class, 'updatePassword'])->name('password.update');
});

// Studio & Management Panel Routes (Accessible to all authenticated users, with system/user modules restricted to admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Website Group (Editable Elements)
    Route::prefix('website')->name('website.')->group(function () {
        Route::get('/content', [AdminWebsiteController::class, 'index'])->name('content');
        Route::post('/content', [AdminWebsiteController::class, 'update'])->name('content.update');
    });

    // Page Elements (Home, About, Contact, Service, Project, Resume, Blog, FAQ)
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [AdminWebsiteController::class, 'home'])->name('index');
        Route::get('/home', [AdminWebsiteController::class, 'home'])->name('home');
        Route::get('/about', [AdminWebsiteController::class, 'about'])->name('about');
        Route::get('/contact', [AdminWebsiteController::class, 'contact'])->name('contact');
        Route::get('/service', [AdminWebsiteController::class, 'service'])->name('service');
        Route::get('/project', [AdminWebsiteController::class, 'project'])->name('project');
        Route::get('/portfolio', [AdminWebsiteController::class, 'project'])->name('portfolio');
        Route::get('/resume', [AdminWebsiteController::class, 'resume'])->name('resume');
        Route::get('/blog', [AdminWebsiteController::class, 'blog'])->name('blog');
        Route::get('/faq', [AdminWebsiteController::class, 'faq'])->name('faq');
        Route::post('/update', [AdminWebsiteController::class, 'update'])->name('update');
    });

    // Content Resource Managers (Under Website Group in navigation)
    Route::resource('services', AdminServiceController::class);
    Route::resource('projects', AdminProjectController::class);
    Route::resource('skills', AdminSkillController::class);
    Route::post('/resume/upload-pdf', [AdminResumeController::class, 'uploadPdf'])->name('resume.uploadPdf');
    Route::delete('/resume/delete-pdf', [AdminResumeController::class, 'deletePdf'])->name('resume.deletePdf');
    Route::resource('resume', AdminResumeController::class);
    Route::resource('blog', AdminBlogController::class);
    Route::resource('faqs', AdminFaqController::class);
    Route::resource('pricing', AdminPricingController::class);
    Route::resource('testimonials', AdminTestimonialController::class);

    // Inquiries / Messages Module
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/batch', [AdminMessageController::class, 'batchAction'])->name('messages.batch');
    Route::post('/messages/autosave-draft', [AdminMessageController::class, 'autosaveDraft'])->name('messages.autosaveDraft');
    Route::post('/messages/send-compose', [AdminMessageController::class, 'sendCompose'])->name('messages.sendCompose');
    Route::post('/messages/empty-trash', [AdminMessageController::class, 'emptyTrash'])->name('messages.emptyTrash');
    Route::post('/messages/{id}/restore', [AdminMessageController::class, 'restore'])->name('messages.restore');
    Route::delete('/messages/{id}/force-delete', [AdminMessageController::class, 'forceDelete'])->name('messages.forceDelete');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/toggle-read', [AdminMessageController::class, 'toggleRead'])->name('messages.toggleRead');
    Route::post('/messages/{message}/toggle-important', [AdminMessageController::class, 'toggleImportant'])->name('messages.toggleImportant');
    Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');
    Route::get('/messages/{message}/preview-reply', [AdminMessageController::class, 'previewReply'])->name('messages.previewReply');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    // Notifications Module (System Group)
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [AdminNotificationController::class, 'index'])->name('index');
        Route::get('/unread-count', [AdminNotificationController::class, 'unreadCount'])->name('unreadCount');
        Route::post('/mark-all-read', [AdminNotificationController::class, 'markAllRead'])->name('markAllRead');
        Route::post('/clear-read', [AdminNotificationController::class, 'clearRead'])->name('clearRead');
        Route::post('/bulk', [AdminNotificationController::class, 'bulkAction'])->name('bulk');
        Route::get('/{notification}', [AdminNotificationController::class, 'show'])->name('show');
        Route::post('/{notification}/toggle-read', [AdminNotificationController::class, 'toggleRead'])->name('toggleRead');
        Route::delete('/{notification}', [AdminNotificationController::class, 'destroy'])->name('destroy');
    });

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminSettingController::class, 'index'])->name('index');

        // General Settings
        Route::get('/general', [AdminSettingController::class, 'general'])->name('general');
        Route::post('/general', [AdminSettingController::class, 'updateGeneral'])->name('general.update');

        // Theme Settings
        Route::get('/theme', [AdminSettingController::class, 'theme'])->name('theme');
        Route::post('/theme', [AdminSettingController::class, 'updateTheme'])->name('theme.update');

        // Image Upload
        Route::get('/images', [AdminSettingController::class, 'images'])->name('images');
        Route::post('/images', [AdminSettingController::class, 'updateImages'])->name('images.update');

        // Social Media
        Route::get('/social', [AdminSettingController::class, 'social'])->name('social');
        Route::post('/social', [AdminSettingController::class, 'updateSocial'])->name('social.update');

        // Backward compatibility
        Route::post('/', [AdminSettingController::class, 'update'])->name('update');
    });

    // Admin Profile & Account Settings
    Route::get('/profile', [AdminUserController::class, 'profile'])->name('profile');
    Route::get('/account', [AdminUserController::class, 'account'])->name('account');
    Route::post('/account/profile', [AdminUserController::class, 'updateAccountProfile'])->name('account.profile');
    Route::post('/account/password', [AdminUserController::class, 'updateAccountPassword'])->name('account.password');
    Route::post('/account/resume-pdf', [AdminResumeController::class, 'uploadPdf'])->name('account.uploadPdf');
    Route::delete('/account/resume-pdf', [AdminResumeController::class, 'deletePdf'])->name('account.deletePdf');

    // ONLY ADMIN CAN ACCESS: System Maintenance & User Management
    Route::middleware(['admin'])->group(function () {
        // Maintenance & System Management Module
        Route::get('/maintenance', [AdminMaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('/maintenance/cache', [AdminMaintenanceController::class, 'clearCache'])->name('maintenance.clearCache');
        Route::post('/maintenance/toggle', [AdminMaintenanceController::class, 'toggleMaintenance'])->name('maintenance.toggle');
        Route::post('/maintenance/upgrade-status', [AdminMaintenanceController::class, 'upgradeStatus'])->name('maintenance.upgradeStatus');
        Route::get('/maintenance/preview-email', [AdminMaintenanceController::class, 'previewEmail'])->name('maintenance.previewEmail');
        Route::post('/maintenance/send-test-email', [AdminMaintenanceController::class, 'sendTestEmail'])->name('maintenance.sendTestEmail');

        // User Management Module
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::post('/users/{user}/role', [AdminUserController::class, 'toggleRole'])->name('users.toggleRole');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});

// Error Pages Showcase & Preview Routes
Route::prefix('errors')->group(function () {
    Route::get('/', function () {
        $errors = [
            '4xx' => [
                '400' => ['title' => 'Bad Request', 'desc' => 'The server cannot process the request due to malformed syntax.', 'color' => '#f59e0b'],
                '401' => ['title' => 'Unauthorized', 'desc' => 'The request requires user authentication credentials that are missing or invalid.', 'color' => '#6366f1'],
                '403' => ['title' => 'Forbidden', 'desc' => 'The server refuses to give the content because the user lacks permission.', 'color' => '#f43f5e'],
                '404' => ['title' => 'Not Found', 'desc' => 'The server cannot find the requested page or URL.', 'color' => '#0090e7'],
                '405' => ['title' => 'Method Not Allowed', 'desc' => 'The HTTP method used (such as GET or POST) is not supported for that resource.', 'color' => '#a855f7'],
                '408' => ['title' => 'Request Timeout', 'desc' => "The server timed out waiting for the browser's request.", 'color' => '#f97316'],
                '410' => ['title' => 'Gone', 'desc' => 'The requested page has been permanently deleted and will not return.', 'color' => '#94a3b8'],
                '429' => ['title' => 'Too Many Requests', 'desc' => 'The user has sent too many requests in a given amount of time (rate-limited).', 'color' => '#eab308'],
            ],
            '5xx' => [
                '500' => ['title' => 'Internal Server Error', 'desc' => 'A generic catch-all error for an unexpected problem on the server.', 'color' => '#ef4444'],
                '502' => ['title' => 'Bad Gateway', 'desc' => 'An upstream or proxy server received an invalid response from another server.', 'color' => '#fb923c'],
                '503' => ['title' => 'Service Unavailable', 'desc' => 'The server is temporarily overloaded or down for maintenance.', 'color' => '#f59e0b'],
                '504' => ['title' => 'Gateway Timeout', 'desc' => 'The server took too long to get a response from an upstream server or database.', 'color' => '#e11d48'],
            ],
        ];
        return view('errors.index', compact('errors'));
    })->name('errors.index');

    Route::get('/{code}', function ($code) {
        $allowed = ['400', '401', '403', '404', '405', '408', '410', '429', '500', '502', '503', '504'];
        if (in_array((string) $code, $allowed, true)) {
            return response()->view("errors.{$code}", [], (int) $code);
        }
        abort(404);
    })->name('errors.show');
});
