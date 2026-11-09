<?php

namespace App\Models;

use App\Traits\AutoSortOrderById;
use App\Traits\HasCategoryOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory, HasCategoryOptions, AutoSortOrderById;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'date',
        'read_time',
        'author',
        'author_avatar',
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
     *
     * @param string|\DateTimeInterface|null $value
     * @return string|null
     */
    public function getDateAttribute(string|\DateTimeInterface|null $value = null): ?string
    {
        if (!empty($value)) {
            $ts = is_string($value) ? strtotime($value) : $value->getTimestamp();
            return $ts ? date('M d, Y', $ts) : (string) $value;
        }

        return $this->created_at?->format('M d, Y') ?? date('M d, Y');
    }

    /**
     * Accessor: YYYY-MM-DD format for datepicker input fields.
     */
    public function getDateInputAttribute(): string
    {
        $raw = $this->getRawOriginal('date');
        if (!empty($raw) && strtotime((string) $raw)) {
            return date('Y-m-d', strtotime((string) $raw));
        }

        return $this->created_at?->format('Y-m-d') ?? date('Y-m-d');
    }

    /**
     * Mutator: ensure any saved date is converted into valid MySQL YYYY-MM-DD.
     *
     * @param string|\DateTimeInterface|null $value
     * @return void
     */
    public function setDateAttribute(string|\DateTimeInterface|null $value): void
    {
        if (!empty($value)) {
            $ts = is_string($value) ? strtotime($value) : $value->getTimestamp();
            $this->attributes['date'] = $ts ? date('Y-m-d', $ts) : (string) $value;
        } else {
            $this->attributes['date'] = date('Y-m-d');
        }
    }

    /**
     * Accessor: resolve local image path to full URL.
     *
     * @param string|null $value
     * @return string|null
     */
    public function getImageAttribute(?string $value = null): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://') || str_starts_with($value, '//')) {
            return $value;
        }

        return asset($value);
    }

    /**
     * Accessor: resolve local author avatar image path to full URL.
     *
     * @param string|null $value
     * @return string|null
     */
    public function getAuthorAvatarAttribute(?string $value = null): ?string
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

