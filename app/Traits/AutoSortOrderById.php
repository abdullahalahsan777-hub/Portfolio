<?php

namespace App\Traits;

trait AutoSortOrderById
{
    /**
     * Boot the trait to auto-populate sort_order with id on creation.
     */
    public static function bootAutoSortOrderById(): void
    {
        static::created(function ($model) {
            if (empty($model->sort_order)) {
                $model->sort_order = $model->id;
                $model->saveQuietly();
            }
        });

        static::updating(function ($model) {
            // Preserve existing sort_order if updated data left sort_order empty
            if (empty($model->sort_order) && !empty($model->getOriginal('sort_order'))) {
                $model->sort_order = $model->getOriginal('sort_order');
            }
        });
    }
}
