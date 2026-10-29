<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * Safely resolve a route URL without throwing if route does not exist.
     */
    public static function safeRoute(string $name, mixed $params = []): ?string
    {
        try {
            return route($name, $params);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Register model event listeners for lifecycle changes.
     * Only inbound events (e.g. new visitor inquiries) trigger administrative notifications.
     */
    public static function registerListeners(): void
    {
        // Inbound visitor inquiries listener (broadcast to administrators)
        ContactMessage::created(function (ContactMessage $item) {
            // Only notify for incoming visitor inquiries (skip composer drafts and sent correspondence)
            if (in_array($item->type, ['draft', 'sent'])) {
                return;
            }

            $subject = $item->subject ?: ($item->service_type ?: 'General Inquiry');
            Notification::record([
                'user_id'   => null, // Broadcast to all admins
                'type'      => 'inquiry',
                'title'     => 'New Inquiry from ' . $item->name,
                'message'   => 'Subject: ' . $subject . ' — ' . Str::limit($item->message, 80),
                'action_url'=> self::safeRoute('admin.messages.show', $item->id),
                'icon'      => 'mail',
                'color'     => 'indigo',
            ]);
        });
    }
}
