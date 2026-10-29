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
        'attachments',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'is_important' => 'boolean',
            'attachments' => 'array',
        ];
    }

    /**
     * Determine if message has attachments.
     */
    public function hasAttachments(): bool
    {
        return !empty($this->attachments) && is_array($this->attachments) && count($this->attachments) > 0;
    }

    /**
     * Determine if message has important status.
     */
    public function isImportant(): bool
    {
        return (bool) ($this->is_important || $this->type === 'important');
    }
}
