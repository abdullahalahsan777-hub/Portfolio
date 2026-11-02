<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VersionController extends Controller
{
    /**
     * GitHub Repository Base URLs
     */
    protected string $githubRepoUrl = 'https://github.com/abdullahalahsan777-hub/Portfolio';

    /**
     * Common foundational modules retained identically across all versions.
     */
    protected array $foundationalCoreModules = [
        'Website Group Module' => 'Unified Website Studio Editor, Dynamic Sections & all Page Elements (Home, About, Contact, Services, Projects, Skills, Resume, Blog, FAQs, Pricing, Testimonials).',
        'Authentication Subsystem' => 'Secure authentication gateway with session regeneration, login, registration, password recovery, and role-based access control.',
        'Account & Profile Management' => 'Admin profile management, avatar image upload, credentials update, and security password controls.',
        'General & Brand Settings' => 'Global site title, metadata, copyright notice, social links, contact coordinates, and brand customization.',
        'Image & Media Engine' => 'Software logo, favicon, dark mode logos, placeholders, and GD-based WebP image optimization pipeline.',
        'Theme Engine Core' => 'Multi-theme presentation architecture supporting Developer, App Developer, App Software Developer, UI/UX Designer, and Graphic Designer themes.',
    ];

    /**
     * Structured Release Matrix: All stable versions from v1.0.0 to v1.2.0.
     */
    protected function getVersionsList(): array
    {
        $currentAppVersion = config('app.version', '1.2.0');

        return [
            [
                'version'       => 'v1.2.0',
                'raw_version'   => '1.2.0',
                'name'          => 'Enterprise Security Hardening & Full Responsive Overhaul',
                'release_date'  => '2026-10-02',
                'is_current'    => true,
                'is_stable'     => true,
                'status_label'  => 'Current Stable Release',
                'status_color'  => 'emerald',
                'commit'        => 'HEAD',
                'summary'       => 'Comprehensive enterprise security fortification, SQL injection audit verification, script execution prohibition in uploads, SecurityHeaders middleware, rate-limiting throttle protection, fixed 100vh admin sidebar, and full responsiveness across all screen sizes.',
                'version_features' => [
                    'Root Gateway Security Policy' => 'Root-level .htaccess protecting .env, composer.json, .git, and all internal Laravel directories from unauthorized direct HTTP requests.',
                    'Upload Script Execution Prohibition' => 'Hardened .htaccess in public/uploads and storage/app/public disabling mod_php engines and denying execution of .php, .phtml, .phar, .sh, and .exe files.',
                    'Helper Upload File Extension Blacklist' => 'Second-layer defense in uploadFile() rejecting all executable and script extensions before filesystem writes.',
                    'HTTP Security Headers Middleware' => 'Automatic injection of X-Frame-Options (SAMEORIGIN), X-Content-Type-Options (nosniff), X-XSS-Protection, Referrer-Policy, and Permissions-Policy on all web responses.',
                    'Anti-Brute-Force & DoS Throttle' => 'Rate limiting on public endpoints: Contact inquiries (15/min), Newsletter (15/min), Login (10/min), Register (10/min), and Password reset (5/min).',
                    'Fixed 100vh Admin Sidebar' => 'Desktop pinned sidebar with sleek custom scrollbars, preventing top-scrolling and page overflow.',
                    'Universal Device Responsiveness' => 'Mobile action bars, bounded dropdown popovers, and seamless fluid layouts across large monitors, laptops, tablets, and phones.',
                    'Client Diagnostic Noise Filter' => 'Smart suppression of third-party ad-blocker extensions and benign network drops in browser error reporter.',
                ],
            ],
            [
                'version'       => 'v1.1.9',
                'raw_version'   => '1.1.9',
                'name'          => 'Newsletter Subscription Engine & Pro Windowed Pagination',
                'release_date'  => '2026-10-01',
                'is_current'    => false,
                'is_stable'     => true,
                'status_label'  => 'Stable Release',
                'status_color'  => 'indigo',
                'commit'        => 'c92962e',
                'summary'       => 'Complete Newsletter subscription subsystem with front-end form integration, admin subscriber management, dashboard metrics telemetry, and mathematical sliding window pagination.',
                'version_features' => [
                    'Newsletter Subscription Subsystem' => 'Public AJAX subscription route, email validation, and dedicated database migration (subscribers table).',
                    'Admin Subscriber Management' => 'Admin list view with bulk deletion, quick copy email action, status badges, and mailto triggers.',
                    'Dashboard Newsletter Metrics Card' => 'Real-time telemetry card on admin dashboard displaying active subscriber counts and audience health.',
                    'Smart Windowed Pagination' => 'Mathematical sliding window (1 2 3 [4] 5 ... 11) capping pagination to 7 buttons with zero scrollbars on all screens.',
                    'Scroll-to-Top Auto Hide' => 'Enhanced back-to-top floating button that automatically hides when scrolling stops across all themes.',
                ],
            ],
            [
                'version'       => 'v1.1.8',
                'raw_version'   => '1.1.8',
                'name'          => 'Unified System & Browser Diagnostics Center',
                'release_date'  => '2026-09-30',
                'is_current'    => false,
                'is_stable'     => true,
                'status_label'  => 'Stable Release',
                'status_color'  => 'indigo',
                'commit'        => 'be01293',
                'summary'       => 'Centralized error and runtime diagnostics center combining backend Laravel exceptions with client-side JavaScript error reporting, telemetry cards, and log downloads.',
                'version_features' => [
                    'Unified Diagnostics Interface' => 'Admin logs viewer (/admin/logs) for searching, filtering, and inspecting both laravel.log and browser.log.',
                    'Client Runtime Error Beacon' => 'Automatic window.onerror and unhandledrejection beacon transmitter for diagnosing frontend failures.',
                    'Diagnostics Telemetry Cards' => 'Two structured metric card rows displaying severity distribution and runtime environment metrics.',
                    'Log File Export & Download' => 'One-click unified download of raw log files and dual-file log clear utilities.',
                ],
            ],
            [
                'version'       => 'v1.1.4',
                'raw_version'   => '1.1.4',
                'name'          => 'Client Inquiries & Communications Hub',
                'release_date'  => '2026-09-28',
                'is_current'    => false,
                'is_stable'     => true,
                'status_label'  => 'Stable Release',
                'status_color'  => 'indigo',
                'commit'        => '5327b8d',
                'summary'       => 'Gmail-style dark mode communications mailbox with autosaving drafts, VIP client importance inheritance, background file attachments, and HTML email replies.',
                'version_features' => [
                    'Gmail-Style Inquiries Hub' => 'Modern dark-mode mailbox with hover action buttons, selection checkboxes, and folder navigation (Inbox, Sent, Drafts, Important, Trash).',
                    'Real-Time Autosave Drafts' => 'Background autosaving composer with temporary UUID identifiers (temp_id).',
                    'VIP Importance Inheritance' => 'Automatic VIP client badge assignment based on sender inquiry history.',
                    'Asynchronous File Attachments' => 'Background attachment upload to public storage with dark mode attachment chips.',
                    'Branded HTML Reply Email' => 'Responsive HTML email templates sent to clients with attested file attachments and background queue delivery.',
                ],
            ],
            [
                'version'       => 'v1.1.1',
                'raw_version'   => '1.1.1',
                'name'          => 'System Maintenance & Infrastructure Hub',
                'release_date'  => '2026-09-25',
                'is_current'    => false,
                'is_stable'     => true,
                'status_label'  => 'Stable Release',
                'status_color'  => 'indigo',
                'commit'        => 'cc94965',
                'summary'       => 'Production infrastructure management center with maintenance mode toggles, automated email broadcasts, database sizing telemetry, and cache clearance.',
                'version_features' => [
                    'Maintenance Mode Engine' => 'Configurable HTTP 503 maintenance mode with admin bypass preview and customizable downtime messaging.',
                    'Automated Broadcast Emails' => 'Server status change emails automatically dispatched to all registered users upon maintenance toggle.',
                    'Database Telemetry' => 'Real-time database sizing calculations querying MySQL information_schema and SQLite storage.',
                    'Cache Management' => 'Admin controls to purge compiled views, route caches, and application configurations.',
                ],
            ],
            [
                'version'       => 'v1.1.0',
                'raw_version'   => '1.1.0',
                'name'          => 'Custom Error Pages Suite & Resilience Showcase',
                'release_date'  => '2026-09-20',
                'is_current'    => false,
                'is_stable'     => true,
                'status_label'  => 'Stable Release',
                'status_color'  => 'indigo',
                'commit'        => '10d47a1',
                'summary'       => 'Complete suite of customized 4xx client and 5xx server error pages with responsive illustrations, diagnostic error codes, and interactive showcase hub.',
                'version_features' => [
                    'Full 4xx & 5xx Error Suite' => 'Custom branded error pages for 400, 401, 403, 404, 405, 408, 410, 429, 500, 502, 503, and 504.',
                    'Interactive Error Showcase' => 'Preview hub (/errors) allowing administrators to audit all HTTP error states and visual presentations.',
                    'Structured Exception Reporting' => 'Global exception report handling logging route, action, method, URL, user identity, and IP address.',
                ],
            ],
            [
                'version'       => 'v1.0.0',
                'raw_version'   => '1.0.0',
                'name'          => 'Foundational Multi-Theme Portfolio Studio Release',
                'release_date'  => '2026-09-15',
                'is_current'    => false,
                'is_stable'     => true,
                'status_label'  => 'Stable Foundation',
                'status_color'  => 'slate',
                'commit'        => '0c1fbb1',
                'summary'       => 'Initial foundation release delivering the multi-theme portfolio studio with five specialized frontend themes, full administrative content management, and user authentication.',
                'version_features' => [
                    'Multi-Theme Architecture' => 'Five themes: Developer, App Developer, App Software Developer, UI/UX Designer, and Graphic Designer.',
                    'Complete Website Group' => 'Dynamic Website Studio editor managing Home, About, Contact, Services, Projects, Skills, Resume, Blog, FAQs, Pricing, and Testimonials.',
                    'Authentication Engine' => 'Complete auth system supporting email/password, registration, password resets, and Socialite Google/Facebook OAuth.',
                    'User & Role Management' => 'Account creation, role toggling (admin/user), and dedicated client user dashboards.',
                    'Media Asset Management' => 'WebP image conversion, logo management, social media configuration, and general site settings.',
                ],
            ],
        ];
    }

    /**
     * Display the Version Control & Software Releases Center.
     */
    public function index(): View
    {
        $versions = $this->getVersionsList();
        $currentVersion = $versions[0];
        $coreModules = $this->foundationalCoreModules;
        $repoUrl = $this->githubRepoUrl;

        return view('admin.versions.index', compact('versions', 'currentVersion', 'coreModules', 'repoUrl'));
    }

    /**
     * Download a specific software version archive from GitHub.
     */
    public function download(string $version, Request $request): RedirectResponse
    {
        $cleanVersion = trim($version);
        if (!str_starts_with($cleanVersion, 'v')) {
            $cleanVersion = 'v' . $cleanVersion;
        }

        $validVersions = ['v1.0.0', 'v1.1.0', 'v1.1.1', 'v1.1.4', 'v1.1.8', 'v1.1.9', 'v1.2.0'];
        if (!in_array($cleanVersion, $validVersions, true)) {
            flash()->danger("Requested version '{$version}' is not recognized.");

            return redirect()->route('admin.versions.index');
        }

        $format = $request->query('format', 'zip');
        $extension = ($format === 'tar' || $format === 'tar.gz') ? 'tar.gz' : 'zip';

        $downloadUrl = "{$this->githubRepoUrl}/archive/refs/tags/{$cleanVersion}.{$extension}";

        return redirect()->away($downloadUrl);
    }
}

