<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subtitle',
        'price',
        'billing_period',
        'features',
        'is_featured',
        'button_text',
        'button_url',
        'theme',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'price'       => 'decimal:2',
        ];
    }

    /**
     * Parse features into an array
     */
    public function getFeaturesListAttribute(): array
    {
        if (empty($this->features)) {
            return [];
        }

        $decoded = json_decode($this->features, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        return array_filter(array_map('trim', explode("\n", $this->features)));
    }
}
