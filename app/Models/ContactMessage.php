<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'service_type',
        'type',
        'temp_id',
        'is_important',
        'message',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'is_important' => 'boolean',
        ];
    }

    /**
     * Determine if message has important status.
     */
    public function isImportant(): bool
    {
        return (bool) ($this->is_important || $this->type === 'important');
    }
}
