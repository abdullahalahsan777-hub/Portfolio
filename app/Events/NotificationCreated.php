<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Notification $notification;

    /**
     * Create a new event instance.
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification->load('user');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [new Channel('notifications')];

        if ($this->notification->user_id) {
            $channels[] = new Channel('notifications.' . $this->notification->user_id);
        }

        return $channels;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'notification.created';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->notification->id,
            'user_id' => $this->notification->user_id,
            'user_name' => $this->notification->user ? $this->notification->user->name : 'System',
            'user_avatar' => $this->notification->user && $this->notification->user->avatar ? asset($this->notification->user->avatar) : null,
            'type' => $this->notification->type,
            'title' => $this->notification->title,
            'message' => $this->notification->message,
            'action_url' => $this->notification->action_url,
            'icon' => $this->notification->icon,
            'color' => $this->notification->color,
            'is_read' => $this->notification->is_read,
            'created_at_human' => $this->notification->created_at->diffForHumans(),
            'created_at' => $this->notification->created_at->format('M d, Y h:i A'),
        ];
    }
}
