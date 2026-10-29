<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Maintenance Notice — {{ $siteName }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #070c18; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #070c18; padding: 40px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #0b1324; border-radius: 20px; border: 1px solid rgba(245, 158, 11, 0.25); overflow: hidden; box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.7), 0 0 40px -10px rgba(245, 158, 11, 0.15);">
                    
                    <!-- Top Accent Gradient Bar -->
                    <tr>
                        <td style="height: 5px; background: linear-gradient(90deg, #f59e0b 0%, #f97316 50%, #ef4444 100%);"></td>
                    </tr>

                    <!-- Brand Header & Status Pill -->
                    <tr>
                        <td style="padding: 36px 40px 16px 40px; text-align: center;">
                            <!-- Status Badge -->
                            <div style="display: inline-block; padding: 6px 14px; border-radius: 50px; background-color: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.35); margin-bottom: 18px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                                    <tr>
                                        <td style="width: 8px; height: 8px; border-radius: 50%; background-color: #f59e0b;"></td>
                                        <td style="padding-left: 8px; font-size: 11px; font-weight: 700; color: #fbbf24; letter-spacing: 0.08em; text-transform: uppercase; font-family: monospace;">
                                            HTTP 503 &bull; Scheduled Maintenance Active
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <h1 style="margin: 0; font-size: 26px; font-weight: 900; color: #ffffff; letter-spacing: -0.02em;">
                                {{ $siteName }}<span style="color: #f59e0b;">.</span>
                            </h1>
                            <p style="margin: 6px 0 0 0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.12em; color: #94a3b8; font-family: monospace;">
                                Infrastructure Maintenance &bull; System Notice
                            </p>
                        </td>
                    </tr>

                    <!-- Hero Warning Banner Box -->
                    <tr>
                        <td style="padding: 10px 40px 20px 40px;">
                            <div style="background: linear-gradient(145deg, rgba(245, 158, 11, 0.12) 0%, rgba(15, 23, 42, 0.6) 100%); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 14px; padding: 22px; text-align: left;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 44px; vertical-align: top; padding-right: 14px;">
                                            <div style="width: 42px; height: 42px; border-radius: 10px; background-color: rgba(245, 158, 11, 0.2); border: 1px solid rgba(245, 158, 11, 0.4); text-align: center; line-height: 42px; font-size: 20px;">
                                                ⚠️
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <h2 style="margin: 0; font-size: 17px; font-weight: 800; color: #ffffff; line-height: 1.3;">
                                                {{ $title ?? 'System Upgrade in Progress' }}
                                            </h2>
                                            <p style="margin: 4px 0 0 0; font-size: 12px; color: #fcd34d; font-family: monospace;">
                                                {{ $estimatedTime ?? 'Estimated duration: 15–30 minutes' }}
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
                                Hello <strong style="color: #ffffff;">{{ $user->name ?? 'Valued Member' }}</strong>,
                            </p>

                            <p style="font-size: 14px; line-height: 1.65; color: #cbd5e1; margin: 0 0 20px 0;">
                                We are writing to inform you that the platform has temporarily entered scheduled maintenance mode for infrastructure optimizations and performance upgrades.
                            </p>

                            <!-- Notice Details Card -->
                            <div style="background-color: rgba(2, 6, 23, 0.6); border-left: 3px solid #f59e0b; border-radius: 8px; padding: 16px 20px; margin: 0 0 24px 0;">
                                <p style="margin: 0; font-size: 13px; line-height: 1.6; color: #e2e8f0; font-style: italic;">
                                    "{{ $noticeMessage ?? 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.' }}"
                                </p>
                            </div>

                            <!-- Specification Table -->
                            <div style="background-color: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 18px 20px; margin: 0 0 24px 0;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="font-size: 12px;">
                                    <tr>
                                        <td style="padding: 6px 0; color: #94a3b8; width: 40%; font-family: monospace;">Started At:</td>
                                        <td style="padding: 6px 0; color: #ffffff; font-weight: 600; text-align: right; font-family: monospace;">{{ $startedAt ?? now()->format('M d, Y • h:i A T') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0; color: #94a3b8; border-top: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace;">Estimated Duration:</td>
                                        <td style="padding: 6px 0; color: #fbbf24; font-weight: 600; text-align: right; border-top: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace;">{{ $estimatedTime ?? '15–30 minutes' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0; color: #94a3b8; border-top: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace;">Affected Portals:</td>
                                        <td style="padding: 6px 0; color: #f87171; font-weight: 600; text-align: right; border-top: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace;">Frontend &bull; User Dashboard</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 0; color: #94a3b8; border-top: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace;">Data Safety:</td>
                                        <td style="padding: 6px 0; color: #34d399; font-weight: 600; text-align: right; border-top: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace;">100% Encrypted &bull; Intact</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- What This Means For You -->
                            <h3 style="margin: 0 0 10px 0; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; font-family: monospace;">
                                What this means for you:
                            </h3>
                            <ul style="margin: 0 0 26px 0; padding-left: 20px; font-size: 13px; line-height: 1.6; color: #cbd5e1;">
                                <li style="margin-bottom: 6px;">Frontend themes and user portals will display an HTTP 503 Service Unavailable notice during this window.</li>
                                <li style="margin-bottom: 6px;">All user profiles, settings, and portfolio data remain completely safe and unaffected.</li>
                                <li><strong>No action is required</strong> on your part. You will receive an automatic email as soon as the server is restored to live status.</li>
                            </ul>

                            <!-- Call to Action Button -->
                            <div style="text-align: center; margin: 30px 0 16px 0;">
                                <a href="{{ $statusUrl ?? url('/errors/503') }}" style="display: inline-block; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #070c18; font-size: 13px; font-weight: 800; text-decoration: none; padding: 14px 34px; border-radius: 12px; letter-spacing: 0.05em; text-transform: uppercase; box-shadow: 0 12px 25px -5px rgba(245, 158, 11, 0.4);">
                                    Check Live Status Page &rarr;
                                </a>
                            </div>

                            <!-- Support Help Note -->
                            <p style="font-size: 12px; line-height: 1.5; color: #64748b; text-align: center; margin: 20px 0 0 0;">
                                If you have urgent inquiries, reach out to our team at
                                <a href="mailto:{{ $contactEmail ?? 'support@portfolio.local' }}" style="color: #fbbf24; text-decoration: underline;">{{ $contactEmail ?? 'support@portfolio.local' }}</a>.
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
                                This is an automated server infrastructure alert dispatched to all registered accounts.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
