<?php

namespace App\Models;

use App\Events\NotificationCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'action_url',
        'icon',
        'color',
        'is_read',
        'read_at',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'data'    => 'array',
        ];
    }

    /**
     * The associated user (recipient or actor).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for querying notifications according to viewing user's role.
     * Administrators see all user & admin notifications.
     * Regular users see only their own notifications.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\User|null $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, ?User $user = null)
    {
        /** @var User|null $user */
        $user = $user ?? Auth::user();

        if (! $user) {
            return $query->whereRaw('1 = 0');
        }

        if ($user instanceof User ? $user->isAdmin() : (($user->role ?? null) === 'admin')) {
            return $query; // Admin sees all user and system notifications
        }

        return $query->where('user_id', $user->id);
    }

    /**
     * Scope unread notifications.
     */
    public function scopeUnread($query = null)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope read notifications.
     */
    public function scopeRead($query = null)
    {
        return $query->where('is_read', true);
    }

    /**
     * Convenient static method to record any application notification and broadcast it.
     */
    public static function record(array $attributes): self
    {
        $notification = self::create([
            'user_id'   => $attributes['user_id'] ?? null,
            'type'      => $attributes['type'] ?? 'general',
            'title'     => $attributes['title'] ?? 'Notification',
            'message'   => $attributes['message'] ?? '',
            'action_url'=> $attributes['action_url'] ?? null,
            'icon'      => $attributes['icon'] ?? 'bell',
            'color'     => $attributes['color'] ?? 'indigo',
            'is_read'   => false,
            'read_at'   => null,
            'data'      => $attributes['data'] ?? null,
        ]);

        // Attempt broadcasting event
        try {
            event(new NotificationCreated($notification));
        } catch (\Throwable $e) {
            Log::info('Broadcast notification skipped or logged: ' . $e->getMessage());
        }

        return $notification;
    }

    /**
     * Mark this notification as read.
     */
    public function markAsRead(): bool
    {
        return $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark this notification as unread.
     */
    public function markAsUnread(): bool
    {
        return $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }
}
