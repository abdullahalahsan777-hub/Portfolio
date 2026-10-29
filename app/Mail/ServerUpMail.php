<?php

namespace App\Mail;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServerUpMail extends Mailable
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

        return new Envelope(
            subject: "🚀 [Service Restored] System Back Online & Fully Operational — {$siteName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.server-up',
            with: [
                'user' => $this->user,
                'siteName' => $this->details['siteName'] ?? SiteSetting::get('site_name', config('app.name', 'Portfolio Studio')),
                'title' => $this->details['title'] ?? 'System Restored & Live Online',
                'noticeMessage' => $this->details['noticeMessage'] ?? $this->details['message'] ?? 'All frontend portfolio themes, user dashboards, and application services are back online and operating normally at peak performance. Thank you for your patience while we upgraded our infrastructure!',
                'restoredAt' => $this->details['restoredAt'] ?? now()->format('M d, Y • h:i A T'),
                'dashboardUrl' => $this->details['dashboardUrl'] ?? route('login'),
                'contactEmail' => $this->details['contactEmail'] ?? SiteSetting::get('contact_email', config('mail.from.address', 'support@portfolio.local')),
            ],
        );
    }
}
