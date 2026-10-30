<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LogViewerController extends Controller
{
    /**
     * Display the unified error and application logs interface.
     */
    public function index(Request $request): View
    {
        $logFiles = $this->getAvailableLogFiles();

        $currentSource = $request->query('source', 'all');
        $currentLevel = strtolower($request->query('level', 'all'));
        $search = trim((string) $request->query('search', ''));
        $perPage = (int) $request->query('per_page', 20);
        if ($perPage < 10 || $perPage > 200) {
            $perPage = 20;
        }

        // Determine which files to read based on source selection
        $filesToRead = [];
        if ($currentSource === 'browser') {
            if (isset($logFiles['browser.log'])) {
                $filesToRead['browser.log'] = $logFiles['browser.log']['path'];
            }
        } elseif ($currentSource === 'laravel') {
            foreach ($logFiles as $name => $meta) {
                if ($name !== 'browser.log') {
                    $filesToRead[$name] = $meta['path'];
                }
            }
        } elseif (isset($logFiles[$currentSource])) {
            $filesToRead[$currentSource] = $logFiles[$currentSource]['path'];
        } else {
            // 'all'
            foreach ($logFiles as $name => $meta) {
                $filesToRead[$name] = $meta['path'];
            }
        }

        // Parse entries from the targeted files
        $allEntries = $this->parseLogFiles($filesToRead);

        $todayStr = now()->toDateString();
        $todayCount = $allEntries->filter(function ($entry) use ($todayStr) {
            return isset($entry['timestamp_raw']) && str_starts_with($entry['timestamp_raw'], $todayStr);
        })->count();

        // Compute summary counts before level and keyword filtering
        $stats = [
            'total'         => $allEntries->count(),
            'errors'        => $allEntries->whereIn('level', ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR'])->count(),
            'warnings'      => $allEntries->where('level', 'WARNING')->count(),
            'info'          => $allEntries->whereIn('level', ['INFO', 'NOTICE'])->count(),
            'debug'         => $allEntries->where('level', 'DEBUG')->count(),
            'browser'       => $allEntries->where('is_browser', true)->count(),
            'backend'       => $allEntries->where('is_browser', false)->count(),
            'today'         => $todayCount,
            'file_count'    => count($logFiles),
            'total_size_mb' => round(array_sum(array_column($logFiles, 'size_bytes')) / 1024 / 1024, 2),
            'php_version'   => 'PHP ' . PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION,
            'laravel_ver'   => 'v' . app()->version(),
            'environment'   => strtoupper(app()->environment()),
            'debug_mode'    => config('app.debug'),
            'last_recorded' => $allEntries->first()['time_ago'] ?? 'None',
        ];

        // Apply Level filter
        $filtered = $allEntries;
        if ($currentLevel !== 'all') {
            if ($currentLevel === 'error') {
                $filtered = $filtered->whereIn('level', ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR']);
            } elseif ($currentLevel === 'warning') {
                $filtered = $filtered->where('level', 'WARNING');
            } elseif ($currentLevel === 'info') {
                $filtered = $filtered->whereIn('level', ['INFO', 'NOTICE']);
            } elseif ($currentLevel === 'debug') {
                $filtered = $filtered->where('level', 'DEBUG');
            } elseif ($currentLevel === 'browser') {
                $filtered = $filtered->where('is_browser', true);
            } elseif ($currentLevel === 'backend') {
                $filtered = $filtered->where('is_browser', false);
            } elseif ($currentLevel === 'today') {
                $filtered = $filtered->filter(fn($e) => isset($e['timestamp_raw']) && str_starts_with($e['timestamp_raw'], $todayStr));
            }
        }

        // Apply Search Filter
        if (!empty($search)) {
            $lowerSearch = strtolower($search);
            $filtered = $filtered->filter(function ($entry) use ($lowerSearch) {
                return str_contains(strtolower($entry['message']), $lowerSearch)
                    || str_contains(strtolower($entry['stack_trace'] ?? ''), $lowerSearch)
                    || str_contains(strtolower($entry['file'] ?? ''), $lowerSearch)
                    || str_contains(strtolower($entry['context_json'] ?? ''), $lowerSearch);
            });
        }

        // Paginate results
        $page = (int) $request->query('page', 1);
        $totalItems = $filtered->count();
        $offset = ($page - 1) * $perPage;
        $itemsForPage = $filtered->slice($offset, $perPage)->values();

        $paginatedLogs = new LengthAwarePaginator(
            $itemsForPage,
            $totalItems,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.logs.index', [
            'logs'          => $paginatedLogs,
            'stats'         => $stats,
            'logFiles'      => $logFiles,
            'currentSource' => $currentSource,
            'currentLevel'  => $currentLevel,
            'search'        => $search,
            'perPage'       => $perPage,
        ]);
    }

    /**
     * Shortcut for viewing browser-specific logs.
     */
    public function browserLogs(Request $request): View
    {
        $request->merge(['source' => 'browser']);
        return $this->index($request);
    }

    /**
     * Shortcut for viewing Laravel-specific logs.
     */
    public function laravelLogs(Request $request): View
    {
        $request->merge(['source' => 'laravel']);
        return $this->index($request);
    }

    /**
     * Public endpoint to log frontend browser errors into storage/logs/browser.log.
     */
    public function recordBrowserError(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
            if (empty($input) || !isset($input['message'])) {
                $raw = $request->getContent();
                $decoded = json_decode($raw, true);
                if (is_array($decoded)) {
                    $input = array_merge($input, $decoded);
                }
            }

            $message = trim((string) ($input['message'] ?? 'Unknown client JavaScript error'));
            $source = (string) ($input['source'] ?? 'browser');
            $lineno = (int) ($input['lineno'] ?? 0);
            $colno = (int) ($input['colno'] ?? 0);
            $stack = (string) ($input['stack'] ?? '');
            $pageUrl = (string) ($input['url'] ?? $request->fullUrl());
            $userAgent = $request->userAgent() ?? 'N/A';
            $ip = $request->ip() ?? 'N/A';

            $userDesc = 'Guest';
            if (Auth::check()) {
                $u = Auth::user();
                $userDesc = "User #{$u->id} ({$u->name} - {$u->email}) [Role: {$u->role}]";
            }

            $context = [
                'type'       => 'browser_error',
                'source'     => $source,
                'line'       => $lineno,
                'col'        => $colno,
                'page_url'   => $pageUrl,
                'user'       => $userDesc,
                'ip'         => $ip,
                'user_agent' => $userAgent,
                'viewport'   => $request->input('viewport', 'N/A'),
            ];

            $logMessage = sprintf(
                "[Browser JavaScript Error] %s in %s:%d:%d | URL: %s | Client: %s | IP: %s",
                $message,
                $source,
                $lineno,
                $colno,
                $pageUrl,
                $userDesc,
                $ip
            );

            if (!empty($stack)) {
                $logMessage .= "\n[stacktrace]\n" . $stack;
            }

            // Write to dedicated storage/logs/browser.log
            Log::channel('browser')->error($logMessage, $context);

            return response()->json([
                'success' => true,
                'message' => 'Browser error recorded in browser.log.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear / empty both Browser and Laravel log files (or specified file).
     */
    public function clear(Request $request): RedirectResponse
    {
        $target = $request->input('file', 'all');
        $available = $this->getAvailableLogFiles();

        if ($target === 'all') {
            foreach ($available as $fileInfo) {
                if (File::exists($fileInfo['path'])) {
                    File::put($fileInfo['path'], '');
                }
            }
            // Also explicitly guarantee standard files are cleared if they exist
            $standardPaths = [storage_path('logs/laravel.log'), storage_path('logs/browser.log')];
            foreach ($standardPaths as $p) {
                if (File::exists($p)) {
                    File::put($p, '');
                }
            }
            flash()->success('Both Browser and Laravel diagnostic log files have been successfully cleared.');
        } elseif (isset($available[$target])) {
            File::put($available[$target]['path'], '');
            flash()->success("Log file '{$target}' has been successfully cleared.");
        } else {
            flash()->warning('Specified log file not found.');
        }

        return redirect()->route('admin.logs.index');
    }

    /**
     * Download log file(s).
     * Combines all data from both Browser and Laravel log files,
     * sorted descending by datetime, named "System & Browser Diagnostics.log".
     */
    public function download(Request $request): Response|BinaryFileResponse|RedirectResponse
    {
        $fileName = $request->query('file');
        $available = $this->getAvailableLogFiles();

        // If a specific individual file was requested (and not 'all')
        if (!empty($fileName) && $fileName !== 'all' && isset($available[$fileName])) {
            return response()->download($available[$fileName]['path'], $fileName);
        }

        // Combine both Browser and Laravel (and any other available) logs
        $filesToRead = [];
        foreach ($available as $name => $meta) {
            $filesToRead[$name] = $meta['path'];
        }

        // Parse and sort descending by date/time
        $allEntries = $this->parseLogFiles($filesToRead);

        $output = "================================================================================\n";
        $output .= " SYSTEM & BROWSER DIAGNOSTICS LOG EXPORT\n";
        $output .= " Exported At      : " . now()->format('Y-m-d H:i:s T') . "\n";
        $output .= " Total Entries    : " . $allEntries->count() . "\n";
        $output .= " Sources Included : Laravel Backend (laravel.log) & Browser Console (browser.log)\n";
        $output .= " Order            : Date & Time Descending (Newest First)\n";
        $output .= "================================================================================\n\n";

        foreach ($allEntries as $entry) {
            $output .= sprintf(
                "[%s] %s.%s: %s\n",
                $entry['timestamp_raw'],
                $entry['environment'] ?? ($entry['is_browser'] ? 'browser' : 'local'),
                $entry['level'],
                $entry['message']
            );

            if (!empty($entry['context_json'])) {
                $output .= "[context] " . $entry['context_json'] . "\n";
            }

            if (!empty($entry['stack_trace'])) {
                $output .= "[stacktrace]\n" . $entry['stack_trace'] . "\n";
            }

            $output .= "\n";
        }

        $downloadName = 'System & Browser Diagnostics.log';

        return response($output, 200, [
            'Content-Type'        => 'text/plain; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"',
        ]);
    }

    /**
     * Trigger a test error to verify logging infrastructure.
     */
    public function testError(Request $request): RedirectResponse
    {
        $type = $request->input('type', 'backend');

        if ($type === 'browser') {
            Log::channel('browser')->error(
                "[Browser Test Error] Manual diagnostic test event triggered by Administrator at " . now()->toIso8601String(),
                [
                    'source'   => url()->current(),
                    'user'     => Auth::user() ? Auth::user()->name : 'Admin',
                    'ip'       => $request->ip(),
                    'line'     => 42,
                    'is_test'  => true,
                ]
            );
            flash()->success('Test browser error logged to storage/logs/browser.log.');
        } else {
            Log::error(
                "[Controller Test Error] Diagnostic test exception generated by " . (Auth::user() ? Auth::user()->name : 'Admin') . " at " . now()->toIso8601String(),
                [
                    'action'    => self::class . '@testError',
                    'route'     => 'admin.logs.testError',
                    'url'       => $request->fullUrl(),
                    'user_id'   => Auth::id(),
                    'ip'        => $request->ip(),
                    'is_test'   => true,
                ]
            );
            flash()->success('Test backend error logged to storage/logs/laravel.log.');
        }

        return redirect()->back();
    }

    /**
     * Locate all .log files in storage/logs directory.
     */
    protected function getAvailableLogFiles(): array
    {
        $logsDir = storage_path('logs');
        if (!File::isDirectory($logsDir)) {
            return [];
        }

        $files = File::files($logsDir);
        $result = [];

        foreach ($files as $file) {
            if ($file->getExtension() !== 'log') {
                continue;
            }

            $name = $file->getFilename();
            $bytes = $file->getSize();
            $formattedSize = $this->formatBytes($bytes);
            $lastModified = Carbon::createFromTimestamp($file->getMTime());

            $result[$name] = [
                'name'          => $name,
                'path'          => $file->getRealPath(),
                'size_bytes'    => $bytes,
                'size_human'    => $formattedSize,
                'modified_at'   => $lastModified,
                'modified_diff' => $lastModified->diffForHumans(),
                'is_browser'    => $name === 'browser.log',
            ];
        }

        // Sort so laravel.log and browser.log appear first
        uksort($result, function ($a, $b) {
            if ($a === 'laravel.log') return -1;
            if ($b === 'laravel.log') return 1;
            if ($a === 'browser.log') return -1;
            if ($b === 'browser.log') return 1;
            return strcmp($a, $b);
        });

        return $result;
    }

    /**
     * Efficiently parse multiple log files into a unified Collection.
     */
    protected function parseLogFiles(array $files): Collection
    {
        $allEntries = collect();

        foreach ($files as $fileName => $path) {
            if (!File::exists($path)) {
                continue;
            }

            $isBrowser = ($fileName === 'browser.log');
            $rawContent = $this->tailFile($path, 2500); // Read up to recent 2,500 lines to preserve responsiveness

            $fileEntries = $this->parseLogContent($rawContent, $fileName, $isBrowser);
            $allEntries = $allEntries->merge($fileEntries);
        }

        // Sort combined logs newest first
        return $allEntries->sortByDesc('timestamp_raw')->values();
    }

    /**
     * Read the last N lines from a file without loading entire multi-megabyte files into memory.
     */
    protected function tailFile(string $filepath, int $lines = 2500): string
    {
        $f = @fopen($filepath, "rb");
        if ($f === false) return "";

        fseek($f, 0, SEEK_END);
        $fileSize = ftell($f);
        if ($fileSize === 0) {
            fclose($f);
            return "";
        }

        // For files smaller than 1.5MB, just read the file directly
        if ($fileSize < 1572864) {
            rewind($f);
            $content = fread($f, $fileSize);
            fclose($f);
            return $content;
        }

        // For larger files, seek backwards from end
        $buffer = "";
        $lineCount = 0;
        $chunkSize = 65536; // 64KB
        $pos = $fileSize;

        while ($pos > 0 && $lineCount < $lines) {
            $readSize = min($chunkSize, $pos);
            $pos -= $readSize;
            fseek($f, $pos);
            $chunk = fread($f, $readSize);
            $buffer = $chunk . $buffer;
            $lineCount = substr_count($buffer, "\n");
        }

        fclose($f);
        return $buffer;
    }

    /**
     * Regex parse raw Monolog text into structured log items.
     */
    protected function parseLogContent(string $content, string $fileName, bool $isBrowser): Collection
    {
        if (empty(trim($content))) {
            return collect();
        }

        $pattern = '/^\[(\d{4}-\d{2}-\d{2}[ T]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:[+-]\d{2}:\d{2})?)\]\s+(?:([a-zA-Z0-9_\-]+)\.)?([A-Za-z]+):\s+([\s\S]*?)(?=(?:^\[\d{4}-\d{2}-\d{2})|\z)/m';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $entries = collect();

        foreach ($matches as $match) {
            $rawDate = $match[1];
            $env = $match[2] ?: ($isBrowser ? 'browser' : 'local');
            $level = strtoupper($match[3]);
            $body = trim($match[4]);

            // Separate main message from stacktrace or JSON context
            $stackTrace = null;
            $contextJson = null;

            if (str_contains($body, '[stacktrace]')) {
                $parts = explode('[stacktrace]', $body, 2);
                $body = trim($parts[0]);
                $stackTrace = trim($parts[1]);
            }

            // Extract trailing JSON context if present e.g. { "url": ... }
            if (preg_match('/\{[\s\S]*\}\s*$/', $body, $jsonMatch)) {
                $possibleJson = $jsonMatch[0];
                $decoded = json_decode($possibleJson, true);
                if (is_array($decoded)) {
                    $contextJson = $possibleJson;
                    $body = trim(substr($body, 0, -strlen($possibleJson)));
                }
            }

            try {
                $dt = Carbon::parse($rawDate);
                $formattedTime = $dt->format('M d, Y • h:i:s A');
                $humanDiff = $dt->diffForHumans();
                $timestampRaw = $dt->timestamp;
            } catch (\Throwable $e) {
                $formattedTime = $rawDate;
                $humanDiff = 'N/A';
                $timestampRaw = 0;
            }

            $entries->push([
                'id'            => md5($rawDate . $level . substr($body, 0, 80)),
                'file'          => $fileName,
                'is_browser'    => $isBrowser || ($env === 'browser'),
                'raw_date'      => $rawDate,
                'timestamp_raw' => $timestampRaw,
                'time_human'    => $formattedTime,
                'time_ago'      => $humanDiff,
                'environment'   => $env,
                'level'         => $level,
                'message'       => $body,
                'context_json'  => $contextJson,
                'stack_trace'   => $stackTrace,
            ]);
        }

        return $entries;
    }

    /**
     * Format raw bytes into human readable string.
     */
    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
