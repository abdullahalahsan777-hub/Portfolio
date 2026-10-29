<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <meta name="color-scheme" content="dark">
    <meta name="supported-color-schemes" content="dark">
    <title>Password Reset Request — {{ $siteName }}</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* CSS Reset & Email Client Normalization */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            min-width: 100% !important;
            background-color: #0b1120 !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
        }
        table, td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
            border-collapse: collapse !important;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
        }
        u + #body a {
            color: inherit;
            text-decoration: none;
        }

        /* Mobile Responsive Media Queries */
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 16px 8px !important;
            }
            .email-container {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 16px !important;
            }
            .email-header-pad {
                padding: 28px 20px 14px 20px !important;
            }
            .email-body-pad {
                padding: 12px 20px 24px 20px !important;
            }
            .email-footer-pad {
                padding: 20px 16px !important;
            }
            .mobile-h1 {
                font-size: 22px !important;
                line-height: 1.25 !important;
            }
            .mobile-body-text {
                font-size: 14px !important;
                line-height: 1.6 !important;
            }
            .mobile-btn {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box !important;
                padding: 14px 20px !important;
                text-align: center !important;
            }
        }

        @media only screen and (max-width: 400px) {
            .email-wrapper {
                padding: 10px 4px !important;
            }
            .email-header-pad {
                padding: 22px 14px 12px 14px !important;
            }
            .email-body-pad {
                padding: 10px 14px 20px 14px !important;
            }
            .mobile-h1 {
                font-size: 20px !important;
            }
        }
    </style>
</head>
<body id="body" style="margin: 0; padding: 0; background-color: #0b1120; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0; -webkit-font-smoothing: antialiased;">
    <!-- Outer Centering Table -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" class="email-wrapper" style="background-color: #0b1120; padding: 40px 15px; width: 100%;">
        <tr>
            <td align="center" valign="top">
                <!--[if (gte mso 9)|(IE)]>
                <table role="presentation" width="580" align="center" style="width: 580px; margin: 0 auto;">
                <tr>
                <td>
                <![endif]-->

                <!-- Main Container -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" class="email-container" style="max-width: 580px; width: 100%; background-color: #0f172a; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); margin: 0 auto;">
                    
                    <!-- Header Bar with Gradient Accent -->
                    <tr>
                        <td style="height: 4px; background: linear-gradient(90deg, #e26d9b 0%, #a855f7 50%, #00ff88 100%); line-height: 4px; font-size: 1px;">&nbsp;</td>
                    </tr>

                    <!-- Brand Header -->
                    <tr>
                        <td class="email-header-pad" style="padding: 35px 40px 20px 40px; text-align: center;">
                            <h1 class="mobile-h1" style="margin: 0; font-size: 24px; font-weight: 800; color: #ffffff; letter-spacing: -0.02em; line-height: 1.2;">
                                {{ $siteName }}<span style="color: #e26d9b;">.</span>
                            </h1>
                            <p style="margin: 6px 0 0 0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; font-family: monospace;">
                                Security Verification &bull; Account Access
                            </p>
                        </td>
                    </tr>

                    <!-- Content Body -->
                    <tr>
                        <td class="email-body-pad" style="padding: 10px 40px 35px 40px;">
                            <p class="mobile-body-text" style="font-size: 15px; line-height: 1.6; color: #f1f5f9; margin: 0 0 16px 0;">
                                Hello <strong style="color: #ffffff;">{{ $user->name ?? 'Valued User' }}</strong>,
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; color: #cbd5e1; margin: 0 0 24px 0; word-break: break-word;">
                                We received a request to reset the password for your account associated with <span style="color: #38bdf8; font-family: monospace;">{{ $user->email }}</span>.
                            </p>

                            <!-- Primary Action Button -->
                            <div style="text-align: center; margin: 32px 0;">
                                <a href="{{ $resetUrl }}" class="mobile-btn" style="display: inline-block; background: linear-gradient(135deg, #e26d9b 0%, #9333ea 50%, #059669 100%); color: #ffffff; font-size: 13px; font-weight: 700; text-decoration: none; padding: 14px 34px; border-radius: 12px; letter-spacing: 0.05em; text-transform: uppercase; box-shadow: 0 10px 25px -5px rgba(226, 109, 155, 0.4); text-align: center;">
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
                                <p style="font-size: 11px; color: #64748b; margin: 0 0 8px 0; line-height: 1.4;">
                                    If you are having trouble clicking the "Reset Password" button, copy and paste this URL into your web browser:
                                </p>
                                <p style="font-size: 11px; color: #38bdf8; word-break: break-all; overflow-wrap: break-word; margin: 0; font-family: monospace; line-height: 1.4;">
                                    <a href="{{ $resetUrl }}" style="color: #38bdf8; text-decoration: underline;">{{ $resetUrl }}</a>
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="email-footer-pad" style="padding: 24px 40px; background-color: #0b1120; border-top: 1px solid rgba(255, 255, 255, 0.06); text-align: center;">
                            <p style="margin: 0; font-size: 11px; color: #64748b; line-height: 1.5;">
                                &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
                            </p>
                            <p style="margin: 6px 0 0 0; font-size: 10px; color: #475569; line-height: 1.5;">
                                This is an automated security email. Please do not reply directly to this message.
                            </p>
                        </td>
                    </tr>
                </table>

                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
    </table>
</body>
</html>