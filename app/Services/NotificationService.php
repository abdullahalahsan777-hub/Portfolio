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
     * Note: Website Group modules (Service, Project, Skill, Resume, Pricing, Testimonial, Blog, FAQ, WebsiteContent)
     * record their notifications directly in their respective controllers.
     */
    public static function registerListeners(): void
    {
        // =====================================================================
        // 1. Contact Messages / Inquiries Module
        // =====================================================================
        ContactMessage::created(function (ContactMessage $item) {
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

        ContactMessage::updated(function (ContactMessage $item) {
            if ($item->wasChanged('is_read')) {
                $status = $item->is_read ? 'Read' : 'Unread';
                Notification::record([
                    'user_id'   => Auth::id() ?? null,
                    'type'      => 'inquiry',
                    'title'     => "Inquiry Marked as {$status}",
                    'message'   => "Inquiry from '{$item->name}' ({$item->email}) was marked as {$status}.",
                    'action_url'=> self::safeRoute('admin.messages.show', $item->id),
                    'icon'      => 'mail',
                    'color'     => $item->is_read ? 'emerald' : 'amber',
                ]);
            }
        });

        ContactMessage::deleted(function (ContactMessage $item) {
            Notification::record([
                'user_id'       => Auth::id() ?? null,
                'type'          => 'inquiry',
                'title'         => 'Inquiry Deleted',
                'message'       => "Inquiry from '{$item->name}' ({$item->email}) was removed.",
                'action_url'    => self::safeRoute('admin.messages.index'),
                'icon'          => 'mail',
                'color'         => 'rose',
            ]);
        });
    }
}
