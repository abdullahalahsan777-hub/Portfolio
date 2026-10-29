<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Response — {{ $siteName }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #070c18; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #070c18; padding: 40px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container Card -->
                <table role="presentation" width="100%" style="max-width: 620px; background-color: #0b1324; border-radius: 20px; border: 1px solid rgba(99, 102, 241, 0.25); overflow: hidden; box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.7), 0 0 40px -10px rgba(99, 102, 241, 0.15);">
                    
                    <!-- Top Accent Gradient Bar -->
                    <tr>
                        <td style="height: 5px; background: linear-gradient(90deg, #6366f1 0%, #a855f7 50%, #00ff88 100%);"></td>
                    </tr>

                    <!-- Brand Header & Status Pill -->
                    <tr>
                        <td style="padding: 36px 40px 16px 40px; text-align: center;">
                            <!-- Ticket / Status Badge -->
                            <div style="display: inline-block; padding: 6px 14px; border-radius: 50px; background-color: rgba(99, 102, 241, 0.12); border: 1px solid rgba(99, 102, 241, 0.35); margin-bottom: 18px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                                    <tr>
                                        <td style="width: 8px; height: 8px; border-radius: 50%; background-color: #818cf8;"></td>
                                        <td style="padding-left: 8px; font-size: 11px; font-weight: 700; color: #a5b4fc; letter-spacing: 0.08em; text-transform: uppercase; font-family: monospace;">
                                            Inquiry #{{ $messageId ?? '1' }} &bull; Official Response
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <h1 style="margin: 0; font-size: 26px; font-weight: 900; color: #ffffff; letter-spacing: -0.02em;">
                                {{ $siteName }}<span style="color: #6366f1;">.</span>
                            </h1>
                            <p style="margin: 6px 0 0 0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.12em; color: #94a3b8; font-family: monospace;">
                                Client Communications &bull; Direct Message
                            </p>
                        </td>
                    </tr>

                    <!-- Hero Banner Box -->
                    <tr>
                        <td style="padding: 10px 40px 20px 40px;">
                            <div style="background: linear-gradient(145deg, rgba(99, 102, 241, 0.12) 0%, rgba(15, 23, 42, 0.6) 100%); border: 1px solid rgba(99, 102, 241, 0.25); border-radius: 14px; padding: 20px 22px; text-align: left;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 44px; vertical-align: top; padding-right: 14px;">
                                            <div style="width: 42px; height: 42px; border-radius: 10px; background-color: rgba(99, 102, 241, 0.2); border: 1px solid rgba(99, 102, 241, 0.4); text-align: center; line-height: 42px; font-size: 20px;">
                                                💬
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <h2 style="margin: 0; font-size: 16px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                                {{ $subject ?? 'Response to Your Inquiry' }}
                                            </h2>
                                            <p style="margin: 4px 0 0 0; font-size: 12px; color: #c7d2fe; font-family: monospace;">
                                                Dispatched on {{ $sentAt ?? now()->format('M d, Y • h:i A T') }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 10px 40px 30px 40px;">
                            <p style="font-size: 15px; line-height: 1.6; color: #f1f5f9; margin: 0 0 16px 0;">
                                Hello <strong style="color: #ffffff;">{{ $recipientName ?? 'Valued Client' }}</strong>,
                            </p>

                            <!-- Formatted Reply Message Box -->
                            <div style="background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 14px; padding: 22px; margin: 0 0 24px 0; font-size: 14px; line-height: 1.75; color: #e2e8f0;">
                                {!! nl2br(e($replyContent)) !!}
                            </div>

                            @if(!empty($attachmentName))
                            <!-- Attested File Notice -->
                            <div style="background: linear-gradient(145deg, rgba(56, 189, 248, 0.1) 0%, rgba(15, 23, 42, 0.7) 100%); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 12px; padding: 14px 18px; margin: 0 0 24px 0;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 32px; font-size: 18px; vertical-align: middle;">📎</td>
                                        <td style="vertical-align: middle;">
                                            <span style="font-size: 12px; font-weight: 700; color: #38bdf8; font-family: monospace; display: block;">
                                                Attested File Attached
                                            </span>
                                            <span style="font-size: 13px; color: #ffffff; font-weight: 600;">
                                                {{ $attachmentName }}
                                            </span>
                                            @if(!empty($attachmentSize))
                                                <span style="font-size: 11px; color: #94a3b8; font-family: monospace; margin-left: 6px;">({{ $attachmentSize }})</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif

                            <!-- Original Inquiry Context Box -->
                            @if(!empty($originalMessage))
                            <div style="background-color: rgba(2, 6, 23, 0.65); border-left: 3px solid #6366f1; border-radius: 10px; padding: 16px 20px; margin: 0 0 26px 0;">
                                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #818cf8; margin-bottom: 8px; font-family: monospace;">
                                    Your Original Inquiry:
                                </div>
                                <div style="font-size: 11px; color: #94a3b8; font-family: monospace; margin-bottom: 8px;">
                                    From: <span style="color: #cbd5e1;">{{ $originalName ?? 'You' }}</span> &bull; 
                                    Subject: <span style="color: #cbd5e1;">{{ $originalSubject ?? 'General Inquiry' }}</span>
                                </div>
                                <p style="margin: 0; font-size: 13px; line-height: 1.6; color: #cbd5e1; font-style: italic;">
                                    "{!! nl2br(e($originalMessage)) !!}"
                                </p>
                            </div>
                            @endif

                            <!-- Sender / Admin Signature Box -->
                            <div style="background-color: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 16px 20px; margin: 0 0 24px 0;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; font-family: monospace; display: block;">
                                                Warm regards,
                                            </span>
                                            <strong style="font-size: 15px; color: #ffffff; display: block; margin-top: 3px;">
                                                {{ $senderName ?? 'Portfolio Studio' }}
                                            </strong>
                                            <span style="font-size: 12px; color: #a5b4fc; font-family: monospace;">
                                                {{ $senderTitle ?? 'Portfolio Inquiries & Support' }}
                                            </span>
                                        </td>
                                        <td style="text-align: right; vertical-align: middle;">
                                            <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; background-color: rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.3); font-size: 11px; font-family: monospace; color: #c7d2fe;">
                                                Verified Sender
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Action Button -->
                            <div style="text-align: center; margin: 28px 0 16px 0;">
                                <a href="{{ $websiteUrl ?? url('/') }}" style="display: inline-block; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: #ffffff; font-size: 13px; font-weight: 700; text-decoration: none; padding: 13px 32px; border-radius: 12px; letter-spacing: 0.05em; text-transform: uppercase; box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);">
                                    Visit Portfolio Website &rarr;
                                </a>
                            </div>

                            <!-- Reply Note -->
                            <p style="font-size: 12px; line-height: 1.5; color: #64748b; text-align: center; margin: 16px 0 0 0;">
                                You can reply directly to this email to continue our conversation.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 40px; background-color: #070c18; border-top: 1px solid rgba(255, 255, 255, 0.06); text-align: center;">
                            <p style="margin: 0; font-size: 11px; color: #64748b;">
                                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 10px; color: #475569;">
                                This email was sent in direct response to your inquiry submitted via our portfolio contact form.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
