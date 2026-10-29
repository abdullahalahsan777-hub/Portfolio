<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'client_name',
        'client_role',
        'company',
        'avatar',
        'rating',
        'content',
        'theme',
        'sort_order',
    ];

    public function getAvatarAttribute($value = null): ?string
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

