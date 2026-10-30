<?php

use App\Helpers\FlashNotifier;
use App\Models\SiteSetting;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


if (! function_exists('strFilter')) {
    /**
     * Convert underscores to spaces and capitalize words.
     */
    function strFilter(string $text = ''): string
    {
        if (empty($text)) {
            return 'N/A';
        }

        $text = trim($text);
        $text = str_replace('_', ' ', $text);

        return ucwords($text);
    }
}

if (! function_exists('strClean')) {
    /**
     * Remove all non‑alphanumeric characters except dash.
     */
    function strClean(string $text = ''): ?string
    {
        if (empty($text)) {
            return null;
        }

        $text = trim($text);

        // Keep only letters, numbers, and dash
        return preg_replace('/[^a-zA-Z0-9\-]/', '', $text);
    }
}

if (! function_exists('strSlug')) {
    /**
     * Generate a URL‑friendly slug.
     */
    function strSlug(string $text = ''): string
    {
        return Str::slug($text);
    }
}

if (! function_exists('strLimit')) {
    /**
     * Limit a string by number of words.
     */
    function strLimit(string $text, int $count, string $prefix = '...'): string
    {
        return Str::words($text, $count, $prefix);
    }
}

if (! function_exists('uploadFile')) {
    /**
     * Upload any file to a public directory.
     *
     * @param  UploadedFile  $file
     * @param  string  $path  Relative path inside public directory (e.g. 'uploads')
     * @param  string|null  $prefix  Optional filename prefix
     * @return string|false The stored relative path or false on failure
     */
    function uploadFile($file, string $path = 'uploads', ?string $prefix = null): string|false
    {
        if (! $file instanceof UploadedFile || ! $file->isValid()) {
            Log::error('uploadFile: Invalid file upload.');

            return false;
        }

        $destinationPath = public_path($path);

        if (! is_dir($destinationPath)) {
            if (! mkdir($destinationPath, 0755, true) && ! is_dir($destinationPath)) {
                Log::error("uploadFile: Failed to create directory: {$destinationPath}");

                return false;
            }
        }

        if (! is_writable($destinationPath)) {
            Log::error("uploadFile: Directory is not writable: {$destinationPath}");

            return false;
        }

        $extension = $file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'bin';
        $filename = ($prefix ? $prefix.'-' : '').date('ymd').rand(100000, 999999).'.'.$extension;
        $fullFilePath = $destinationPath.DIRECTORY_SEPARATOR.$filename;

        try {
            $file->move($destinationPath, $filename);
        } catch (\Throwable $e) {
            Log::error('uploadFile: Move failed - '.$e->getMessage());

            return false;
        }

        if (! file_exists($fullFilePath)) {
            Log::error("uploadFile: File does not exist after move: {$fullFilePath}");

            return false;
        }

        $cleanPath = trim(str_replace('\\', '/', $path), '/');

        return $cleanPath.'/'.$filename;
    }
}

if (! function_exists('uploadImage')) {
    /**
     * Upload and convert an image to WebP with optional resizing/cropping.
     *
     * @param  UploadedFile  $image
     * @param  string  $path  Relative path inside public directory
     * @param  int  $maxWidth  Desired width (0 = no crop)
     * @param  int  $maxHeight  Desired height (0 = no crop)
     * @param  int  $quality  WebP quality (0-100)
     * @param  string|null  $prefix  Optional filename prefix
     * @return string|false The stored relative path or false on failure
     */
    function uploadImage($image, string $path = 'uploads', int $maxWidth = 0, int $maxHeight = 0, int $quality = 85, ?string $prefix = null): string|false
    {
        if (! $image instanceof UploadedFile || ! $image->isValid()) {
            Log::error('uploadImage: Invalid image upload.');

            return false;
        }

        $mimeType = $image->getMimeType();
        $sourcePath = $image->getRealPath();

        if ($mimeType === 'image/svg+xml') {
            return uploadFile($image, $path, $prefix);
        }

        if (! function_exists('imagewebp')) {
            Log::error('uploadImage: GD does not support WebP.');

            return false;
        }

        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($sourcePath);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                Log::error("uploadImage: Unsupported MIME type: {$mimeType}");

                return false;
        }

        if (! $sourceImage) {
            Log::error('uploadImage: Failed to create image resource.');

            return false;
        }

        imagepalettetotruecolor($sourceImage);

        $origWidth = imagesx($sourceImage);
        $origHeight = imagesy($sourceImage);

        if ($maxWidth > 0 && $maxHeight > 0) {
            $widthRatio = $origWidth / $maxWidth;
            $heightRatio = $origHeight / $maxHeight;

            if ($widthRatio > $heightRatio) {
                $newWidth = $maxWidth;
                $newHeight = (int) round($origHeight / $widthRatio);
            } else {
                $newHeight = $maxHeight;
                $newWidth = (int) round($origWidth / $heightRatio);
            }

            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            unset($sourceImage);

            $cropX = max(0, ($newWidth - $maxWidth) / 2);
            $cropY = max(0, ($newHeight - $maxHeight) / 2);

            $finalImage = imagecreatetruecolor($maxWidth, $maxHeight);
            imagecopyresampled($finalImage, $resizedImage, 0, 0, $cropX, $cropY, $maxWidth, $maxHeight, $maxWidth, $maxHeight);
            unset($resizedImage);
        } else {
            $finalImage = $sourceImage;
            $maxWidth = $origWidth;
            $maxHeight = $origHeight;
        }

        $filename = ($prefix ? $prefix.'-' : '').date('ymd').rand(100000, 999999).'.webp';

        $tempPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.$filename;
        if (! imagewebp($finalImage, $tempPath, $quality)) {
            Log::error('uploadImage: Failed to create WebP image.');
            unset($finalImage);

            return false;
        }
        unset($finalImage);

        $destinationPath = public_path($path);
        if (! is_dir($destinationPath)) {
            if (! mkdir($destinationPath, 0755, true) && ! is_dir($destinationPath)) {
                Log::error("uploadImage: Failed to create directory: {$destinationPath}");
                unlink($tempPath);

                return false;
            }
        }

        if (! is_writable($destinationPath)) {
            Log::error("uploadImage: Directory is not writable: {$destinationPath}");
            unlink($tempPath);

            return false;
        }

        $finalFilePath = $destinationPath.DIRECTORY_SEPARATOR.$filename;
        if (! rename($tempPath, $finalFilePath)) {
            Log::error("uploadImage: Failed to move file from {$tempPath} to {$finalFilePath}");
            unlink($tempPath);

            return false;
        }

        if (! file_exists($finalFilePath)) {
            Log::error("uploadImage: File does not exist after move: {$finalFilePath}");

            return false;
        }

        return $path.'/'.$filename;
    }
}

if (! function_exists('inWordEn')) {
    /**
     * Convert a number into its English words representation.
     *
     * @param  int|float|string  $number
     */
    function inWordEn($number): string
    {
        if (! is_numeric($number)) {
            return '';
        }

        $number = (float) $number;

        // Handle zero
        if ($number == 0) {
            return 'zero';
        }

        // Handle negative numbers
        $negative = $number < 0;
        if ($negative) {
            $number = abs($number);
        }

        $words = [];

        $list1 = [
            '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten',
            'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen',
        ];

        $list2 = [
            '', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred',
        ];

        $list3 = [
            '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion',
        ];

        // Split integer and decimal parts
        $parts = explode('.', number_format($number, 2, '.', ''));
        $integerPart = (int) $parts[0];
        $decimalPart = isset($parts[1]) ? (int) $parts[1] : 0;

        // Convert integer part
        $numStr = str_pad($integerPart, 3 * ceil(strlen($integerPart) / 3), '0', STR_PAD_LEFT);
        $groups = array_reverse(str_split($numStr, 3));

        foreach ($groups as $level => $group) {
            if ((int) $group === 0) {
                continue;
            }

            $hundreds = (int) ($group[0]);
            $tens = (int) ($group[1].$group[2]);

            $groupWords = [];

            if ($hundreds > 0) {
                $groupWords[] = $list1[$hundreds].' hundred';
            }

            if ($tens > 0) {
                if ($tens < 20) {
                    $groupWords[] = $list1[$tens];
                } else {
                    $tensPart = (int) ($group[1] * 10);
                    $units = (int) ($group[2]);
                    $groupWords[] = $list2[$tensPart / 10];
                    if ($units > 0) {
                        $groupWords[] = $list1[$units];
                    }
                }
            }

            if ($level > 0) {
                $groupWords[] = $list3[$level];
            }

            $words[] = implode(' ', $groupWords);
        }

        $result = implode(', ', array_reverse($words));

        // Add decimal part
        if ($decimalPart > 0) {
            $result .= ' point';
            $decimalStr = str_split($decimalPart);
            foreach ($decimalStr as $digit) {
                $result .= ' '.$list1[$digit];
            }
        }

        return $negative ? 'minus '.$result : $result;
    }
}

if (! function_exists('formatDate')) {
    /**
     * Format a date using a given format (default: 'd M Y').
     *
     * @param  mixed  $date
     */
    function formatDate($date, string $format = 'd M Y'): string
    {
        if (empty($date)) {
            return '';
        }

        if (! $date instanceof \DateTimeInterface) {
            try {
                $date = new \DateTime($date);
            } catch (\Throwable $e) {
                return '';
            }
        }

        return $date->format($format);
    }
}

if (! function_exists('formatMoney')) {
    /**
     * Format a number as currency.
     *
     * @param  string  $currency  Symbol or code
     */
    function formatMoney(float $amount, string $currency = '$', int $decimals = 2): string
    {
        return $currency.number_format($amount, $decimals);
    }
}

if (! function_exists('generateRandomString')) {
    /**
     * Generate a random string of specified length.
     */
    function generateRandomString(int $length = 10): string
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
    }
}

if (! function_exists('getSettings')) {
    /**
     * Get all site settings or a specific setting value by key.
     * Universally accessible everywhere in the application (Controllers, Blade views, Models, Services, etc.).
     *
     * Usage examples:
     * - getSettings() : returns all settings as an associative array [key => value]
     * - getSettings('site_title') : returns the value for 'site_title'
     * - getSettings('site_title', 'My Portfolio') : returns value with default fallback
     * - getSettings(['site_title', 'active_theme']) : returns array of requested keys
     *
     * @param  string|array|null  $key  Setting key or array of keys (optional)
     * @param  mixed  $default  Fallback value if key is not found
     * @return mixed
     */
    function getSettings(string|array|null $key = null, mixed $default = null): mixed
    {
        try {
            if ($key === null) {
                return SiteSetting::all()->pluck('value', 'key')->toArray();
            }

            if (is_array($key)) {
                return SiteSetting::whereIn('key', $key)->pluck('value', 'key')->toArray();
            }

            return SiteSetting::get($key, $default);
        } catch (\Throwable $e) {
            return is_array($key) || $key === null ? [] : $default;
        }
    }
}

if (! function_exists('setSettings')) {
    /**
     * Set or update a site setting by key.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @param  string  $group
     * @return mixed
     */
    function setSettings(string $key, mixed $value, string $group = 'general'): mixed
    {
        try {
            return SiteSetting::set($key, $value, $group);
        } catch (\Throwable $e) {
            return false;
        }
    }
}

if (! function_exists('flash')) {
    /**
     * Arrange for a flash message.
     *
     * Usage:
     *   flash()->success('Category Create Successful.');
     *   flash()->error('Something went wrong.');
     *   flash('Default message');
     *
     * @param  string|null  $message
     * @param  string  $level
     * @return \App\Helpers\FlashNotifier
     */
    function flash(?string $message = null, string $level = 'info'): FlashNotifier
    {
        $notifier = app(FlashNotifier::class);

        if (! is_null($message)) {
            $notifier->message($message, $level);
        }

        return $notifier;
    }
}

if (! function_exists('currentUser')) {
    /**
     * Get the currently authenticated User model instance.
     *
     * @return \App\Models\User|null
     */
    function currentUser(): ?\App\Models\User
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        return $user instanceof \App\Models\User ? $user : null;
    }
}
