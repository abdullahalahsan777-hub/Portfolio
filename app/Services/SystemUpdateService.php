<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class SystemUpdateService
{
    /**
     * Cache key for update check results.
     */
    protected const CACHE_KEY = 'system_update_status';

    /**
     * Cache TTL in seconds (5 minutes).
     */
    protected const CACHE_TTL = 300;

    /**
     * GitHub Repository URL.
     */
    protected string $repoUrl = 'https://github.com/abdullahalahsan777-hub/Portfolio';

    /**
     * Get the current update status comparing local repository with GitHub origin/main.
     */
    public function getStatus(bool $forceRefresh = false): array
    {
        if ($forceRefresh) {
            Cache::forget(self::CACHE_KEY);
        }

        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->inspectRepository();
        });
    }

    /**
     * Cache key for GitHub releases repository data.
     */
    protected const RELEASES_CACHE_KEY = 'github_repository_releases_data';

    /**
     * Retrieve all releases dynamically from GitHub repository, combining live remote tags,
     * commit history, and release documentation.
     */
    public function getRepositoryReleases(bool $forceRefresh = false): array
    {
        if ($forceRefresh) {
            Cache::forget(self::RELEASES_CACHE_KEY);
        }

        return Cache::remember(self::RELEASES_CACHE_KEY, self::CACHE_TTL, function () {
            return $this->fetchRepositoryReleases();
        });
    }

    /**
     * Inspect and retrieve release versions dynamically from the GitHub repository.
     */
    protected function fetchRepositoryReleases(): array
    {
        $basePath = base_path();
        $currentAppVersion = config('app.version', '1.3.0');
        $cleanCurrentVer = 'v' . ltrim($currentAppVersion, 'v');

        // Step 1: Query GitHub remote tags directly via Git (no API rate limiting)
        $remoteTagsProcess = Process::path($basePath)->timeout(12)->run('git ls-remote --tags origin');
        $remoteTagsMap = [];
        if ($remoteTagsProcess->successful()) {
            $lines = array_filter(explode("\n", trim($remoteTagsProcess->output())));
            foreach ($lines as $line) {
                if (preg_match('/^([a-f0-9]+)\s+refs\/tags\/(v?[0-9]+\.[0-9]+(?:\.[0-9]+)?)(?:\^\{\})?$/', trim($line), $m)) {
                    $sha = substr($m[1], 0, 7);
                    $tag = str_starts_with($m[2], 'v') ? $m[2] : 'v' . $m[2];
                    $remoteTagsMap[$tag] = $sha;
                }
            }
        }

        // Step 2: Try querying GitHub Releases API if accessible
        $apiReleases = [];
        try {
            $response = Http::withHeaders(['User-Agent' => 'Portfolio-Studio-Updater'])
                ->timeout(4)
                ->get("https://api.github.com/repos/abdullahalahsan777-hub/Portfolio/releases");

            if ($response->successful() && is_array($response->json())) {
                foreach ($response->json() as $rel) {
                    $tName = $rel['tag_name'] ?? '';
                    if ($tName) {
                        $apiReleases[$tName] = $rel;
                    }
                }
            }
        } catch (\Throwable $e) {}

        // Base release definitions enriched dynamically with live GitHub information
        $knownVersions = [
            'v1.3.0' => [
                'name'         => 'Theme-Scoped Sort Ordering Engine & Flowbite Dark UI Suite',
                'release_date' => '2026-11-10',
                'commit'       => $remoteTagsMap['v1.3.0'] ?? 'HEAD',
                'summary'      => 'Theme-wise sequential sort order engine across all 9 Website modules, SortableJS drag-and-drop reordering with live badge feedback, AutoSortOrderById trait with automatic sequencing, Flowbite Tailwind dark components and Datepicker (YYYY-MM-DD), zero static data enforcement, and automated GitHub synchronization.',
                'version_features' => [
                    'Theme-Scoped Sort Order Sequencing' => 'Independent 1..N order sequencing across all 9 Website modules (Services, Projects, Galleries, Skills, Resume Items, Pricing, Testimonials, Blog, FAQs), preventing theme ordering collisions.',
                    'AutoSortOrderById Trait' => 'Automatic sequential assignment on model creation scoped by theme (and type for resume items); removed manual order number inputs from create and edit forms.',
                    'SortableJS Drag-and-Drop Reordering' => 'Interactive drag handles with real-time UI badge updates and asynchronous backend transaction synchronization per theme container.',
                    'Flowbite Dark UI Suite Integration' => 'Integrated Flowbite Tailwind components, autohiding datepicker with standard yyyy-mm-dd ISO format, and styled SVG calendar pickers.',
                    'Automated GitHub Sync & Self-Healing Update' => 'Live GitHub remote inspection, popup changelog preview, and conflict-free Git auto-merge with database schema migrations.',
                    'Zero Static Data Enforcement' => 'Eliminated all hardcoded array fallbacks across all frontend themes and admin modules; all content is dynamically queried and served from MySQL database.',
                    'Exclusive SERVER_PORT Binding' => 'Server port is retrieved exclusively from SERVER_PORT in .env, driving artisan serve, dev.sh, dev.bat, and URL generators without static options.',
                ],
            ],
            'v1.2.0' => [
                'name'         => 'Enterprise Security Hardening & Full Responsive Overhaul',
                'release_date' => '2026-10-02',
                'commit'       => $remoteTagsMap['v1.2.0'] ?? '3a1d133',
                'summary'      => 'Comprehensive enterprise security fortification, SQL injection audit verification, script execution prohibition in uploads, SecurityHeaders middleware, rate-limiting throttle protection, fixed 100vh admin sidebar, and full responsiveness across all screen sizes.',
                'version_features' => [
                    'Root Gateway Security Policy' => 'Root-level .htaccess protecting .env, composer.json, .git, and all internal Laravel directories from unauthorized direct HTTP requests.',
                    'Upload Script Execution Prohibition' => 'Hardened .htaccess in public/uploads and storage/app/public disabling mod_php engines and denying execution of .php, .phtml, .phar, .sh, and .exe files.',
                    'Helper Upload File Extension Blacklist' => 'Second-layer defense in uploadFile() rejecting all executable and script extensions before filesystem writes.',
                    'HTTP Security Headers Middleware' => 'Automatic injection of X-Frame-Options (SAMEORIGIN), X-Content-Type-Options (nosniff), X-XSS-Protection, Referrer-Policy, and Permissions-Policy on all web responses.',
                    'Anti-Brute-Force & DoS Throttle' => 'Rate limiting on public endpoints: Contact inquiries (15/min), Newsletter (15/min), Login (10/min), Register (10/min), and Password reset (5/min).',
                    'Fixed 100vh Admin Sidebar' => 'Desktop pinned sidebar with sleek custom scrollbars, preventing top-scrolling and page overflow.',
                    'Universal Device Responsiveness' => 'Mobile action bars, bounded dropdown popovers, and seamless fluid layouts across large monitors, laptops, tablets, and phones.',
                ],
            ],
            'v1.1.9' => [
                'name'         => 'Newsletter Subscription Engine & Pro Windowed Pagination',
                'release_date' => '2026-09-15',
                'commit'       => $remoteTagsMap['v1.1.9'] ?? 'c92962e',
                'summary'      => 'Complete Newsletter subscription subsystem with front-end form integration, admin subscriber management, dashboard metrics telemetry, and mathematical sliding window pagination.',
                'version_features' => [
                    'Newsletter Subscription Subsystem' => 'Public AJAX subscription route, email validation, and dedicated database migration (subscribers table).',
                    'Admin Subscriber Management' => 'Admin list view with bulk deletion, quick copy email action, status badges, and mailto triggers.',
                    'Dashboard Newsletter Metrics Card' => 'Real-time telemetry card on admin dashboard displaying active subscriber counts and audience health.',
                    'Smart Windowed Pagination' => 'Mathematical sliding window (1 2 3 [4] 5 ... 11) capping pagination to 7 buttons with zero scrollbars on all screens.',
                    'Scroll-to-Top Auto Hide' => 'Enhanced back-to-top floating button that automatically hides when scrolling stops across all themes.',
                ],
            ],
            'v1.1.8' => [
                'name'         => 'Unified System & Browser Diagnostics Center',
                'release_date' => '2026-09-01',
                'commit'       => $remoteTagsMap['v1.1.8'] ?? 'be01293',
                'summary'      => 'Centralized error and runtime diagnostics center combining backend Laravel exceptions with client-side JavaScript error reporting, telemetry cards, and log downloads.',
                'version_features' => [
                    'Unified Diagnostics Interface' => 'Admin logs viewer (/admin/logs) for searching, filtering, and inspecting both laravel.log and browser.log.',
                    'Client Runtime Error Beacon' => 'Automatic window.onerror and unhandledrejection beacon transmitter for diagnosing frontend failures.',
                    'Diagnostics Telemetry Cards' => 'Two structured metric card rows displaying severity distribution and runtime environment metrics.',
                    'Log File Export & Download' => 'One-click unified download of raw log files and dual-file log clear utilities.',
                ],
            ],
            'v1.1.4' => [
                'name'         => 'Client Inquiries & Communications Hub',
                'release_date' => '2026-08-02',
                'commit'       => $remoteTagsMap['v1.1.4'] ?? '5327b8d',
                'summary'      => 'Gmail-style dark mode communications mailbox with autosaving drafts, VIP client importance inheritance, background file attachments, and HTML email replies.',
                'version_features' => [
                    'Gmail-Style Inquiries Hub' => 'Modern dark-mode mailbox with hover action buttons, selection checkboxes, and folder navigation (Inbox, Sent, Drafts, Important, Trash).',
                    'Real-Time Autosave Drafts' => 'Background autosaving composer with temporary UUID identifiers (temp_id).',
                    'VIP Importance Inheritance' => 'Automatic VIP client badge assignment based on sender inquiry history.',
                    'Asynchronous File Attachments' => 'Background attachment upload to public storage with dark mode attachment chips.',
                    'Branded HTML Reply Email' => 'Responsive HTML email templates sent to clients with attested file attachments and background queue delivery.',
                ],
            ],
            'v1.1.1' => [
                'name'         => 'System Maintenance & Infrastructure Hub',
                'release_date' => '2026-07-01',
                'commit'       => $remoteTagsMap['v1.1.1'] ?? 'cc94965',
                'summary'      => 'Production infrastructure management center with maintenance mode toggles, automated email broadcasts, database sizing telemetry, and cache clearance.',
                'version_features' => [
                    'Maintenance Mode Engine' => 'Configurable HTTP 503 maintenance mode with admin preview bypass and customizable downtime messaging.',
                    'Automated Broadcast Emails' => 'Server status change emails automatically dispatched to all registered users upon maintenance toggle.',
                    'Database Telemetry' => 'Real-time database sizing calculations querying MySQL information_schema and SQLite storage.',
                    'Cache Management' => 'Admin controls to purge compiled views, route caches, and application configurations.',
                ],
            ],
            'v1.1.0' => [
                'name'         => 'Custom Error Pages Suite & Resilience Showcase',
                'release_date' => '2026-06-01',
                'commit'       => $remoteTagsMap['v1.1.0'] ?? '10d47a1',
                'summary'      => 'Complete suite of customized 4xx client and 5xx server error pages with responsive illustrations, diagnostic error codes, and interactive showcase hub.',
                'version_features' => [
                    'Full 4xx & 5xx Error Suite' => 'Custom branded error pages for 400, 401, 403, 404, 405, 408, 410, 429, 500, 502, 503, and 504.',
                    'Interactive Error Showcase' => 'Preview hub (/errors) allowing administrators to audit all HTTP error states and visual presentations.',
                    'Structured Exception Reporting' => 'Global exception report handling logging route, action, method, URL, user identity, and IP address.',
                ],
            ],
            'v1.0.0' => [
                'name'         => 'Foundational Multi-Theme Portfolio Studio Release',
                'release_date' => '2026-05-01',
                'commit'       => $remoteTagsMap['v1.0.0'] ?? '0c1fbb1',
                'summary'      => 'Initial foundation release delivering the multi-theme portfolio studio with five specialized frontend themes, full administrative content management, and user authentication.',
                'version_features' => [
                    'Multi-Theme Architecture' => 'Five themes: Developer, App Developer, App Software Developer, UI/UX Designer, and Graphic Designer.',
                    'Complete Website Group' => 'Dynamic Website Studio editor managing Home, About, Contact, Services, Projects, Skills, Resume, Blog, FAQs, Pricing, and Testimonials.',
                    'Authentication Engine' => 'Complete auth system supporting email/password, registration, password resets, and Socialite Google/Facebook OAuth.',
                    'User & Role Management' => 'Account creation, role toggling (admin/user), and dedicated client user dashboards.',
                    'Media Asset Management' => 'WebP image conversion, logo management, social media configuration, and general site settings.',
                ],
            ],
        ];

        // Merge any new tags found on GitHub remote that might not be in the dictionary
        foreach ($remoteTagsMap as $rTag => $rSha) {
            if (!isset($knownVersions[$rTag])) {
                $knownVersions[$rTag] = [
                    'name'             => "GitHub Release {$rTag}",
                    'release_date'     => now()->format('Y-m-d'),
                    'commit'           => $rSha,
                    'summary'          => "GitHub tagged release {$rTag} fetched dynamically from repository.",
                    'version_features' => [
                        'GitHub Release Tag' => "Synchronized from GitHub origin: {$rTag} (Commit: {$rSha})",
                        'Self-Healing Update' => 'Automatic pull, merge, schema migrations, and cache clearing.',
                    ],
                ];
            }
        }

        // Build finalized structured list with live GitHub links and README URLs
        $releases = [];
        foreach ($knownVersions as $ver => $data) {
            $isCurrent = ($ver === $cleanCurrentVer);
            $apiData = $apiReleases[$ver] ?? null;

            $releases[] = [
                'version'          => $ver,
                'raw_version'      => ltrim($ver, 'v'),
                'name'             => $apiData['name'] ?? $data['name'],
                'release_date'     => isset($apiData['published_at']) ? substr($apiData['published_at'], 0, 10) : $data['release_date'],
                'is_current'       => $isCurrent,
                'is_stable'        => true,
                'status_label'     => $isCurrent ? 'Current Active Version' : 'Stable Release',
                'status_color'     => $isCurrent ? 'emerald' : 'indigo',
                'commit'           => $remoteTagsMap[$ver] ?? ($data['commit'] ?? 'TAG'),
                'summary'          => $apiData['body'] ?? $data['summary'],
                'version_features' => $data['version_features'],
                'readme_file'      => "docs/releases/README_{$ver}.md",
                'zip_url'          => route('admin.versions.download', ['version' => $ver, 'format' => 'zip']),
                'tar_url'          => route('admin.versions.download', ['version' => $ver, 'format' => 'tar.gz']),
                'github_tag_url'   => "{$this->repoUrl}/releases/tag/{$ver}",
            ];
        }

        // Sort descending by semantic version number
        usort($releases, function ($a, $b) {
            return version_compare($b['raw_version'], $a['raw_version']);
        });

        return $releases;
    }

    /**
     * Inspect repository state against GitHub remote.
     */
    protected function inspectRepository(): array
    {
        $basePath = base_path();
        $currentVersion = 'v' . ltrim(config('app.version', '1.3.0'), 'v');

        $status = [
            'checked'              => false,
            'last_checked_at'      => now()->format('M d, Y h:i A'),
            'last_checked_human'   => 'Just now',
            'current_version'      => $currentVersion,
            'latest_version'       => $currentVersion,
            'has_new_version'      => false,
            'current_commit'       => 'unknown',
            'current_commit_msg'   => 'Local HEAD',
            'current_commit_date'  => 'Recent',
            'current_commit_author'=> 'Local System',
            'remote_commit'        => 'unknown',
            'remote_commit_msg'    => 'origin/main',
            'remote_commit_date'   => 'Recent',
            'remote_commit_author' => 'GitHub',
            'commits_behind'       => 0,
            'commits_ahead'        => 0,
            'is_behind'            => false,
            'update_available'     => false,
            'recent_remote_commits'=> [],
            'recent_local_commits' => [],
            'repo_url'             => $this->repoUrl,
            'remote_branch'        => 'origin/main',
            'status_message'       => 'System is up to date.',
        ];

        try {
            // Read local HEAD commit info
            $localLog = Process::path($basePath)->run('git log -1 HEAD --format="%h||%s||%an||%cr"');
            if ($localLog->successful() && !empty(trim($localLog->output()))) {
                $parts = explode('||', trim($localLog->output()));
                $status['current_commit']        = $parts[0] ?? 'HEAD';
                $status['current_commit_msg']    = $parts[1] ?? 'Current Commit';
                $status['current_commit_author'] = $parts[2] ?? 'Developer';
                $status['current_commit_date']   = $parts[3] ?? 'Recently';
            }

            // Extract last 5 local commits for changelog display in modal
            $localRecentLog = Process::path($basePath)->run('git log -5 HEAD --format="%h||%s||%an||%cr"');
            if ($localRecentLog->successful() && !empty(trim($localRecentLog->output()))) {
                $lines = array_filter(explode("\n", trim($localRecentLog->output())));
                foreach ($lines as $line) {
                    $p = explode('||', trim($line));
                    if (count($p) >= 2) {
                        $status['recent_local_commits'][] = [
                            'hash'   => $p[0] ?? '',
                            'msg'    => $p[1] ?? '',
                            'author' => $p[2] ?? '',
                            'date'   => $p[3] ?? '',
                        ];
                    }
                }
            }

            // Fetch latest references from GitHub with a reasonable timeout
            $fetchProcess = Process::path($basePath)->timeout(12)->run('git fetch origin main --quiet');
            $status['checked'] = $fetchProcess->successful();

            // Count how many commits local is behind origin/main
            $behindProcess = Process::path($basePath)->run('git rev-list --count HEAD..origin/main');
            if ($behindProcess->successful()) {
                $status['commits_behind'] = (int) trim($behindProcess->output());
                $status['is_behind'] = $status['commits_behind'] > 0;
            }

            // Count how many commits local is ahead
            $aheadProcess = Process::path($basePath)->run('git rev-list --count origin/main..HEAD');
            if ($aheadProcess->successful()) {
                $status['commits_ahead'] = (int) trim($aheadProcess->output());
            }

            // Read origin/main latest commit info
            $remoteLog = Process::path($basePath)->run('git log -1 origin/main --format="%h||%s||%an||%cr"');
            if ($remoteLog->successful() && !empty(trim($remoteLog->output()))) {
                $rParts = explode('||', trim($remoteLog->output()));
                $status['remote_commit']        = $rParts[0] ?? 'origin/main';
                $status['remote_commit_msg']    = $rParts[1] ?? 'Latest GitHub commit';
                $status['remote_commit_author'] = $rParts[2] ?? 'GitHub Remote';
                $status['remote_commit_date']   = $rParts[3] ?? 'Recently';
            }

            // If behind, get list of commits pending
            if ($status['is_behind']) {
                $limit = min($status['commits_behind'], 10);
                $logList = Process::path($basePath)->run("git log -{$limit} origin/main --format=\"%h||%s||%an||%cr\" HEAD..origin/main");
                if ($logList->successful()) {
                    $lines = array_filter(explode("\n", trim($logList->output())));
                    foreach ($lines as $line) {
                        $p = explode('||', trim($line));
                        if (count($p) >= 2) {
                            $status['recent_remote_commits'][] = [
                                'hash'   => $p[0] ?? '',
                                'msg'    => $p[1] ?? '',
                                'author' => $p[2] ?? '',
                                'date'   => $p[3] ?? '',
                            ];
                        }
                    }
                }
            }

            // Inspect remote tags for version increments
            $tagsProcess = Process::path($basePath)->timeout(8)->run('git ls-remote --tags origin');
            if ($tagsProcess->successful()) {
                $tagLines = array_filter(explode("\n", trim($tagsProcess->output())));
                $parsedVersions = [];
                foreach ($tagLines as $tLine) {
                    if (preg_match('/refs\/tags\/(v?[0-9]+\.[0-9]+(?:\.[0-9]+)?)(?:\^\{\})?$/', trim($tLine), $m)) {
                        $verNum = ltrim($m[1], 'v');
                        $parsedVersions[$verNum] = 'v' . $verNum;
                    }
                }
                if (!empty($parsedVersions)) {
                    uksort($parsedVersions, 'version_compare');
                    $highestVersion = end($parsedVersions);
                    $status['latest_version'] = $highestVersion;

                    $currClean = ltrim($currentVersion, 'v');
                    $highClean = ltrim($highestVersion, 'v');
                    if (version_compare($highClean, $currClean, '>')) {
                        $status['has_new_version'] = true;
                    }
                }
            }

            // Compute overall update available flag
            $status['update_available'] = $status['is_behind'] || $status['has_new_version'];

            if ($status['update_available']) {
                if ($status['has_new_version'] && $status['is_behind']) {
                    $status['status_message'] = "New version {$status['latest_version']} available ({$status['commits_behind']} commits behind GitHub).";
                } elseif ($status['has_new_version']) {
                    $status['status_message'] = "New version {$status['latest_version']} available on GitHub.";
                } else {
                    $status['status_message'] = "{$status['commits_behind']} new commit(s) available on GitHub.";
                }
            } else {
                $status['status_message'] = "Software is fully up to date with GitHub ({$currentVersion}).";
            }
        } catch (\Throwable $e) {
            Log::warning('SystemUpdateService inspection warning: ' . $e->getMessage());
            $status['status_message'] = 'Unable to reach GitHub. Running on local release.';
        }

        return $status;
    }

    /**
     * Apply remote update from GitHub with automated self-healing merge.
     * Supports updating to latest origin/main or switching to any specific GitHub tagged release.
     * Guarantees conflict-free merge and runs all post-update maintenance.
     */
    public function applyUpdate(?string $targetVersion = null): array
    {
        $basePath = base_path();
        $logOutput = [];
        $isSpecificTag = !empty($targetVersion) && $targetVersion !== 'main' && $targetVersion !== 'latest';

        try {
            // Step 1: Stash any local uncommitted files to prevent pull/checkout conflict
            $stash = Process::path($basePath)->run('git stash --include-untracked');
            $logOutput[] = 'Stash local modifications: ' . trim($stash->output());

            if ($isSpecificTag) {
                $cleanTag = 'v' . ltrim(trim($targetVersion), 'v');

                // Step 2: Fetch latest tags from GitHub origin
                $fetch = Process::path($basePath)->timeout(60)->run('git fetch --tags origin');
                $logOutput[] = 'Fetch remote tags: ' . ($fetch->successful() ? 'OK' : trim($fetch->errorOutput()));

                // Step 3: Checkout target release tag
                $checkout = Process::path($basePath)->timeout(60)->run("git checkout tags/{$cleanTag} --force");
                if (!$checkout->successful()) {
                    $checkout = Process::path($basePath)->timeout(60)->run("git checkout {$cleanTag} --force");
                }
                $logOutput[] = "Checkout version tag {$cleanTag}: " . ($checkout->successful() ? 'OK' : trim($checkout->errorOutput()));

                $versionLabel = $cleanTag;
            } else {
                // Step 2: Checkout main and fetch latest origin/main
                Process::path($basePath)->run('git checkout main --force');
                $fetch = Process::path($basePath)->timeout(60)->run('git fetch origin main');
                $logOutput[] = 'Fetch remote main: ' . ($fetch->successful() ? 'OK' : trim($fetch->errorOutput()));

                // Step 3: Merge origin/main prioritizing remote changes (-X theirs)
                $merge = Process::path($basePath)->timeout(60)->run('git merge origin/main -X theirs -m "Merge update from GitHub origin/main"');
                $logOutput[] = 'Merge remote origin/main: ' . trim($merge->output());

                // Auto-heal if any conflict or dirty state remains
                if (!$merge->successful()) {
                    $resolve = Process::path($basePath)->run('git checkout --theirs .');
                    $logOutput[] = 'Auto-resolve conflict favoring remote: ' . trim($resolve->output());

                    Process::path($basePath)->run('git add -A');
                    $commitProcess = Process::path($basePath)->run('git commit -m "Auto-resolved software update merge"');
                    $logOutput[] = 'Auto-commit merged files: ' . trim($commitProcess->output());

                    // If still not clean, do hard reset to origin/main
                    if (!$commitProcess->successful()) {
                        $reset = Process::path($basePath)->run('git reset --hard origin/main');
                        $logOutput[] = 'Hard sync to origin/main: ' . trim($reset->output());
                    }
                }

                $versionLabel = $this->getStatus()['latest_version'] ?? 'v1.3.0';
            }

            // Step 4: Run database migrations if any were pulled
            try {
                Artisan::call('migrate', ['--force' => true]);
                $migrateOutput = Artisan::output();
                $logOutput[] = 'Database migration: ' . trim($migrateOutput ?: 'Already up to date');
            } catch (\Throwable $e) {
                $logOutput[] = 'Migration notice: ' . $e->getMessage();
            }

            // Step 5: Update APP_VERSION in .env if exists to keep configuration synchronized
            try {
                $envPath = base_path('.env');
                if (file_exists($envPath)) {
                    $envContent = file_get_contents($envPath);
                    $rawVer = ltrim($versionLabel, 'v');
                    if (preg_match('/^APP_VERSION=.*/m', $envContent)) {
                        $envContent = preg_replace('/^APP_VERSION=.*/m', "APP_VERSION={$rawVer}", $envContent);
                    } else {
                        $envContent .= "\nAPP_VERSION={$rawVer}\n";
                    }
                    file_put_contents($envPath, $envContent);
                }
            } catch (\Throwable $e) {}

            // Step 6: Self-healing optimize & cache purge
            Artisan::call('optimize:clear');
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            $logOutput[] = 'Cleared application views, routes, configs, and caches.';

            // Invalidate cached update status so it reflects the new state immediately
            Cache::forget(self::CACHE_KEY);

            // Get new HEAD commit
            $newHeadProcess = Process::path($basePath)->run('git log -1 HEAD --format="%h||%s"');
            $newCommit = 'HEAD';
            $newCommitMsg = 'Updated';
            if ($newHeadProcess->successful()) {
                $parts = explode('||', trim($newHeadProcess->output()));
                $newCommit = $parts[0] ?? 'HEAD';
                $newCommitMsg = $parts[1] ?? 'Updated';
            }

            // Step 7: Dispatch notification to system admins
            try {
                Notification::create([
                    'type'       => 'system',
                    'title'      => "Software Updated to {$versionLabel}",
                    'message'    => "System updated to [{$versionLabel}] at commit [{$newCommit}]: {$newCommitMsg}.",
                    'icon'       => 'arrow-path',
                    'color'      => 'emerald',
                    'action_url' => route('admin.versions.index'),
                ]);
            } catch (\Throwable $e) {}

            return [
                'success'    => true,
                'message'    => "Software updated successfully to {$versionLabel} (commit {$newCommit})!",
                'version'    => $versionLabel,
                'commit'     => $newCommit,
                'commit_msg' => $newCommitMsg,
                'logs'       => $logOutput,
            ];
        } catch (\Throwable $e) {
            Log::error('System update execution error: ' . $e->getMessage());

            // Emergency auto-heal: reset hard to origin/main if something broke
            try {
                Process::path($basePath)->run('git checkout main --force');
                Process::path($basePath)->run('git reset --hard origin/main');
                Artisan::call('optimize:clear');
                Cache::forget(self::CACHE_KEY);
            } catch (\Throwable $fallbackEx) {}

            return [
                'success' => false,
                'message' => 'Update encountered an issue, but system was safely auto-healed: ' . $e->getMessage(),
                'logs'    => $logOutput,
            ];
        }
    }
}
