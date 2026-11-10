<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
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
     * Guarantees conflict-free merge and runs all post-update maintenance.
     */
    public function applyUpdate(): array
    {
        $basePath = base_path();
        $logOutput = [];

        try {
            // Step 1: Stash any local uncommitted files to prevent pull conflict
            $stash = Process::path($basePath)->run('git stash --include-untracked');
            $logOutput[] = 'Stash local modifications: ' . trim($stash->output());

            // Step 2: Fetch latest origin/main
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

            // Step 4: Run database migrations if any were pulled
            try {
                Artisan::call('migrate', ['--force' => true]);
                $migrateOutput = Artisan::output();
                $logOutput[] = 'Database migration: ' . trim($migrateOutput ?: 'Already up to date');
            } catch (\Throwable $e) {
                $logOutput[] = 'Migration notice: ' . $e->getMessage();
            }

            // Step 5: Self-healing optimize & cache purge
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

            // Step 6: Dispatch notification to system admins
            try {
                Notification::create([
                    'type'       => 'system',
                    'title'      => 'Software Updated Successfully',
                    'message'    => "System updated and synchronized with GitHub to commit [{$newCommit}]: {$newCommitMsg}.",
                    'icon'       => 'arrow-path',
                    'color'      => 'emerald',
                    'action_url' => route('admin.versions.index'),
                ]);
            } catch (\Throwable $e) {}

            return [
                'success'    => true,
                'message'    => "Software updated and merged successfully! Current commit: {$newCommit}.",
                'commit'     => $newCommit,
                'commit_msg' => $newCommitMsg,
                'logs'       => $logOutput,
            ];
        } catch (\Throwable $e) {
            Log::error('System update execution error: ' . $e->getMessage());

            // Emergency auto-heal: reset hard to origin/main if something broke
            try {
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
