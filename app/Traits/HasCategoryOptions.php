<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Trait HasCategoryOptions
 *
 * Trait providing distinct category listing and randomized quick-select pills
 * for Eloquent models that have a 'category' column.
 *
 * @mixin Model
 * @method static Builder query()
 */
trait HasCategoryOptions
{
    /**
     * Get the database table name for the model using this trait.
     */
    public static function getModelTable(): string
    {
        /** @var Model $instance */
        $instance = new static();
        return $instance->getTable();
    }

    /**
     * Get unique categories sorted alphabetically from the model table.
     */
    public static function getCategories(?string $theme = null): Collection
    {
        /** @var Model $instance */
        $instance = new static();
        $table = $instance->getTable();

        $query = $instance->newQuery()
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
        /** @var Model $instance */
        $instance = new static();
        $table = $instance->getTable();

        $query = $instance->newQuery()
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



