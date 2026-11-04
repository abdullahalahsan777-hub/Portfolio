<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image_url',
        'theme',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer',
        ];
    }

    /**
     * Check if the image exists and is valid.
     */
    public function hasValidImage(): bool
    {
        $raw = $this->attributes['image_url'] ?? null;
        if (empty($raw)) {
            return false;
        }

        // Remote URLs: check valid URL scheme
        if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://') || str_starts_with($raw, '//')) {
            return (bool) filter_var($raw, FILTER_VALIDATE_URL) || str_starts_with($raw, '//');
        }

        // Local public files: verify file existence on disk
        $relativePath = ltrim($raw, '/\\');
        return file_exists(public_path($relativePath));
    }

    /**
     * Ensure full asset URL for relative paths.
     */
    public function getImageUrlAttribute(?string $value = null): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '//') || str_starts_with($value, 'data:')) {
            return $value;
        }

        return '/' . ltrim($value, '/\\');
    }

    /**
     * Raw stored path or URL (for file deletion / editing).
     */
    public function getRawImagePath(): ?string
    {
        return $this->attributes['image_url'] ?? null;
    }

    /**
     * Scope to active gallery items.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to items for a specific theme or 'all'.
     */
    public function scopeForTheme(Builder $query, ?string $theme = null): Builder
    {
        if (empty($theme) || $theme === 'everything') {
            return $query;
        }

        if ($theme === 'all') {
            return $query->where('theme', 'all');
        }

        return $query->whereIn('theme', ['all', $theme]);
    }

    /**
     * Scope to featured gallery items.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get unique categories from galleries table (SELECT DISTINCT category FROM galleries GROUP BY category).
     */
    public static function getCategories(?string $theme = null): Collection
    {
        $query = static::query()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '');

        if ($theme && $theme !== 'all' && $theme !== 'everything') {
            $query->whereIn('theme', ['all', $theme]);
        }

        return $query->groupBy('category')
            ->orderBy('category')
            ->pluck('category')
            ->map(fn($c) => trim($c))
            ->filter()
            ->unique()
            ->values();
    }

    /**
     * Get quick-select categories from galleries table:
     * - The most frequently used category appears 1st.
     * - The remaining categories are randomized on each call/reload.
     */
    public static function getQuickCategories(?string $theme = null): Collection
    {
        $query = static::query()
            ->select('category', \Illuminate\Support\Facades\DB::raw('count(*) as usage_count'))
            ->whereNotNull('category')
            ->where('category', '!=', '');

        if ($theme && $theme !== 'all' && $theme !== 'everything') {
            $query->whereIn('theme', ['all', $theme]);
        }

        $counts = $query->groupBy('category')
            ->orderByDesc('usage_count')
            ->pluck('usage_count', 'category');

        if ($counts->isEmpty()) {
            return collect();
        }

        $mostUsed = $counts->keys()->first();
        $randomOthers = $counts->keys()->slice(1)->shuffle();

        return collect([$mostUsed])->concat($randomOthers)->values();
    }
}
