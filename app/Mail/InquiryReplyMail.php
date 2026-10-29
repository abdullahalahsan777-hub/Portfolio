<?php

namespace App\Mail;

use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryReplyMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $data;
    public ?array $attachmentInfo;

    /**
     * Create a new message instance.
     *
     * @param array $data Message data and variables
     * @param array|null $attachmentInfo Metadata of persistent stored attachment
     */
    public function __construct(array $data, ?array $attachmentInfo = null)
    {
        $this->data = $data;
        $this->attachmentInfo = $attachmentInfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: $this->data['subject'] ?? 'Response to Your Inquiry',
        );

        if (!empty($this->data['cc'])) {
            $envelope->cc($this->data['cc']);
        }

        if (!empty($this->data['bcc'])) {
            $envelope->bcc($this->data['bcc']);
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $siteName = $this->data['siteName'] ?? SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));

        return new Content(
            view: 'emails.inquiry-reply',
            with: [
                'siteName'        => $siteName,
                'messageId'       => $this->data['messageId'] ?? null,
                'subject'         => $this->data['subject'] ?? 'Response to Your Inquiry',
                'sentAt'          => $this->data['sentAt'] ?? now()->format('M d, Y • h:i A T'),
                'recipientName'   => $this->data['recipientName'] ?? 'Valued Client',
                'replyContent'    => $this->data['replyContent'] ?? '',
                'originalName'    => $this->data['originalName'] ?? null,
                'originalEmail'   => $this->data['originalEmail'] ?? null,
                'originalSubject' => $this->data['originalSubject'] ?? null,
                'originalMessage' => $this->data['originalMessage'] ?? null,
                'senderName'      => $this->data['senderName'] ?? 'Portfolio Studio',
                'senderTitle'     => $this->data['senderTitle'] ?? 'Portfolio Inquiries & Support',
                'websiteUrl'      => $this->data['websiteUrl'] ?? url('/'),
                'attachmentName'  => $this->attachmentInfo['name'] ?? null,
                'attachmentSize'  => $this->attachmentInfo['size'] ?? null,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if (!empty($this->attachmentInfo) && !empty($this->attachmentInfo['path'])) {
            return [
                Attachment::fromStorageDisk('local', $this->attachmentInfo['path'])
                    ->as($this->attachmentInfo['name'] ?? 'attachment')
                    ->withMime($this->attachmentInfo['mime'] ?? 'application/octet-stream'),
            ];
        }

        return [];
    }
}
