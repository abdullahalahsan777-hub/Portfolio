<?php

namespace App\Notifications;

use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
        $resetUrl = route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject("Password Reset Request — {$siteName}")
            ->view('emails.password-reset', [
                'resetUrl'  => $resetUrl,
                'user'      => $notifiable,
                'siteName'  => $siteName,
                'expiresIn' => config('auth.passwords.users.expire', 60),
            ]);
    }
}

