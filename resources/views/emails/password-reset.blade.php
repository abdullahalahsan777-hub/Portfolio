<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0b1120; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #0b1120; padding: 40px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" style="max-width: 580px; background-color: #0f172a; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                    
                    <!-- Header Bar with Gradient Accent -->
                    <tr>
                        <td style="height: 4px; background: linear-gradient(90deg, #e26d9b 0%, #a855f7 50%, #00ff88 100%);"></td>
                    </tr>

                    <!-- Brand Header -->
                    <tr>
                        <td style="padding: 35px 40px 20px 40px; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #ffffff; letter-spacing: -0.02em;">
                                {{ $siteName }}<span style="color: #e26d9b;">.</span>
                            </h1>
                            <p style="margin: 6px 0 0 0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; font-family: monospace;">
                                Security Verification &bull; Account Access
                            </p>
                        </td>
                    </tr>

                    <!-- Content Body -->
                    <tr>
                        <td style="padding: 20px 40px 35px 40px;">
                            <p style="font-size: 15px; line-height: 1.6; color: #f1f5f9; margin: 0 0 16px 0;">
                                Hello <strong style="color: #ffffff;">{{ $user->name ?? 'Valued User' }}</strong>,
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; color: #cbd5e1; margin: 0 0 24px 0;">
                                We received a request to reset the password for your account associated with <span style="color: #38bdf8; font-family: monospace;">{{ $user->email }}</span>.
                            </p>

                            <!-- Primary Action Button -->
                            <div style="text-align: center; margin: 32px 0;">
                                <a href="{{ $resetUrl }}" style="display: inline-block; background: linear-gradient(135deg, #e26d9b 0%, #9333ea 50%, #059669 100%); color: #ffffff; font-size: 13px; font-weight: 700; text-decoration: none; padding: 14px 34px; border-radius: 12px; letter-spacing: 0.05em; text-transform: uppercase; box-shadow: 0 10px 25px -5px rgba(226, 109, 155, 0.4);">
                                    Reset Password
                                </a>
                            </div>

                            <!-- Expiry Info Box -->
                            <div style="background-color: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 10px; padding: 14px 18px; margin: 24px 0;">
                                <p style="margin: 0; font-size: 12px; color: #94a3b8; line-height: 1.5;">
                                    <strong style="color: #fbbf24;">&bull; Note:</strong> This password reset link is valid for <strong>{{ $expiresIn }} minutes</strong>. If the link expires, you may request a new one at any time.
                                </p>
                            </div>

                            <p style="font-size: 13px; line-height: 1.6; color: #94a3b8; margin: 20px 0 0 0;">
                                If you did not initiate this password reset request, no action is needed and your account remains safe and secure.
                            </p>

                            <!-- Fallback Direct URL -->
                            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                                <p style="font-size: 11px; color: #64748b; margin: 0 0 8px 0;">
                                    If you are having trouble clicking the "Reset Password" button, copy and paste this URL into your web browser:
                                </p>
                                <p style="font-size: 11px; color: #38bdf8; word-break: break-all; margin: 0; font-family: monospace;">
                                    <a href="{{ $resetUrl }}" style="color: #38bdf8; text-decoration: underline;">{{ $resetUrl }}</a>
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 40px; background-color: #0b1120; border-top: 1px solid rgba(255, 255, 255, 0.06); text-align: center;">
                            <p style="margin: 0; font-size: 11px; color: #64748b;">
                                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 10px; color: #475569;">
                                This is an automated security email. Please do not reply directly to this message.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

