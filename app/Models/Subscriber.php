<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'avatar',
        'ip_address',
        'email_host',
        'user_agent',
        'status',
        'subscribed_at',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
    ];

    /**
     * Get display avatar or fallback Gravatar URL.
     */
    public function getAvatarUrlAttribute(): string
    {
        if (!empty($this->avatar)) {
            return $this->avatar;
        }

        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?s=150&d=identicon";
    }

    /**
     * Get display name or formatted email local part.
     */
    public function getDisplayNameAttribute(): string
    {
        if (!empty($this->name)) {
            return $this->name;
        }

        $local = explode('@', $this->email)[0] ?? 'Subscriber';
        $cleaned = preg_replace('/[._+\-]+/', ' ', $local);
        return ucwords(trim($cleaned)) ?: 'Subscriber';
    }
}

