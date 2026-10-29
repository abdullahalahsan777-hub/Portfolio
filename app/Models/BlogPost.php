<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

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
     */
    public function getDateAttribute($value = null)
    {
        return $value ?: $this->created_at?->format('M d, Y') ?? date('M d, Y');
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

