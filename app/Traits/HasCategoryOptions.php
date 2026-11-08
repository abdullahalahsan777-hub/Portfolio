<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait HasCategoryOptions
{
    /**
     * Get unique categories sorted alphabetically from the model table.
     */
    public static function getCategories(?string $theme = null): Collection
    {
        $table = (new static)->getTable();
        $query = static::query()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '');

        if ($theme && $theme !== 'all' && $theme !== 'everything' && Schema::hasColumn($table, 'theme')) {
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
     * Get quick-select categories:
     * - The most frequently used category appears 1st.
     * - The remaining categories are randomized on each call/reload.
     */
    public static function getQuickCategories(?string $theme = null): Collection
    {
        $table = (new static)->getTable();
        $query = static::query()
            ->select('category', DB::raw('count(*) as usage_count'))
            ->whereNotNull('category')
            ->where('category', '!=', '');

        if ($theme && $theme !== 'all' && $theme !== 'everything' && Schema::hasColumn($table, 'theme')) {
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
