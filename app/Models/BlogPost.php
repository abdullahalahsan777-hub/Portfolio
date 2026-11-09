<?php

namespace App\Models;

use App\Traits\HasCategoryOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory, HasCategoryOptions;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'date',
        'read_time',
        'author',
        'image',
        'excerpt',
        'content',
        'theme',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Accessor: date falls back to formatted created_at if empty.
     * Formats nicely for display (e.g. 'Oct 18, 2026').
     */
    public function getDateAttribute($value = null): ?string
    {
        if (!empty($value)) {
            $ts = strtotime($value);
            return $ts ? date('M d, Y', $ts) : $value;
        }

        return $this->created_at?->format('M d, Y') ?? date('M d, Y');
    }

    /**
     * Accessor: YYYY-MM-DD format for datepicker input fields.
     */
    public function getDateInputAttribute(): string
    {
        $raw = $this->getRawOriginal('date');
        if (!empty($raw) && strtotime($raw)) {
            return date('Y-m-d', strtotime($raw));
        }

        return $this->created_at?->format('Y-m-d') ?? date('Y-m-d');
    }

    /**
     * Mutator: ensure any saved date is converted into valid MySQL YYYY-MM-DD.
     */
    public function setDateAttribute($value): void
    {
        if (!empty($value)) {
            $ts = strtotime($value);
            $this->attributes['date'] = $ts ? date('Y-m-d', $ts) : $value;
        } else {
            $this->attributes['date'] = date('Y-m-d');
        }
    }

    /**
     * Accessor: resolve local image path to full URL.
     */
    public function getImageAttribute($value = null): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '//')) {
            return $value;
        }

        return asset($value);
    }
}

