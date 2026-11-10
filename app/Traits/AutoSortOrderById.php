<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait to automatically assign theme-wise sequential sort_order upon creation.
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static void creating(callable|\Closure $callback)
 * @method static void updating(callable|\Closure $callback)
 */
trait AutoSortOrderById
{
    /**
     * Boot the trait to auto-populate sort_order theme-wise on creation.
     */
    public static function bootAutoSortOrderById(): void
    {
        static::creating(function (Model $model): void {
            if (empty($model->sort_order)) {
                $query = $model->newQuery();

                // If model has a theme attribute, sequence within that theme
                if (isset($model->theme)) {
                    $query->where('theme', $model->theme);
                }

                // If model has a type attribute (e.g. ResumeItem education vs experience), sequence within type too
                if (isset($model->type)) {
                    $query->where('type', $model->type);
                }

                $maxOrder = (int) ($query->max('sort_order') ?? 0);
                $model->sort_order = $maxOrder + 1;
            }
        });

        static::updating(function (Model $model): void {
            if (empty($model->sort_order) && !empty($model->getOriginal('sort_order'))) {
                $model->sort_order = $model->getOriginal('sort_order');
            }
        });
    }

    /**
     * Scope query to order by sort_order and reliably tie-break by primary key.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query, string $direction = 'asc')
    {
        return $query->orderBy('sort_order', $direction)->orderBy($this->getKeyName(), $direction);
    }
}

