<?php

namespace App\Mail;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServerDownMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public array $details;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, array $details = [])
    {
        $this->user = $user;
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $siteName = $this->details['siteName'] ?? SiteSetting::get('site_name', config('app.name', 'Portfolio Studio'));
        $title = $this->details['title'] ?? SiteSetting::get('maintenance_title', 'System Upgrade in Progress');

        return new Envelope(
            subject: "⚠️ [Maintenance Notice] {$title} — {$siteName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.server-down',
            with: [
                'user' => $this->user,
                'siteName' => $this->details['siteName'] ?? SiteSetting::get('site_name', config('app.name', 'Portfolio Studio')),
                'title' => $this->details['title'] ?? SiteSetting::get('maintenance_title', 'System Upgrade in Progress'),
                'noticeMessage' => $this->details['noticeMessage'] ?? $this->details['message'] ?? SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.'),
                'estimatedTime' => $this->details['estimatedTime'] ?? SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes'),
                'startedAt' => $this->details['startedAt'] ?? now()->format('M d, Y • h:i A T'),
                'statusUrl' => $this->details['statusUrl'] ?? url('/errors/503'),
                'contactEmail' => $this->details['contactEmail'] ?? SiteSetting::get('contact_email', config('mail.from.address', 'support@portfolio.local')),
            ],
        );
    }
}
