<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait to automatically copy primary ID to sort_order upon creation.
 *
 * @mixin Model
 * @method static void created(\Closure|callable|string $callback)
 * @method static void updating(\Closure|callable|string $callback)
 */
trait AutoSortOrderById
{
    /**
     * Boot the trait to auto-populate sort_order with id on creation.
     */
    public static function bootAutoSortOrderById(): void
    {
        static::created(function (Model $model): void {
            if (empty($model->sort_order)) {
                $model->sort_order = $model->id;
                $model->saveQuietly();
            }
        });

        static::updating(function (Model $model): void {
            // Preserve existing sort_order if updated data left sort_order empty
            if (empty($model->sort_order) && !empty($model->getOriginal('sort_order'))) {
                $model->sort_order = $model->getOriginal('sort_order');
            }
        });
    }
}

