<?php

namespace App\Services;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsletterService
{
    /**
     * Subscribe an email address and retrieve name, avatar, IP, and host details.
     */
    public function subscribe(string $email, Request $request): array
    {
        $normalizedEmail = strtolower(trim($email));
        $ip = $this->getClientIp($request);
        $userAgent = substr($request->userAgent() ?? '', 0, 255);

        // Retrieve host details from email
        $hostInfo = $this->resolveEmailHost($normalizedEmail);
        $emailHost = $hostInfo['host'];

        // Retrieve profile info (name & avatar) from email host / providers
        $profile = $this->fetchProfileFromEmailHost($normalizedEmail);
        $name = $profile['name'];
        $avatar = $profile['avatar'];

        // Check if subscriber already exists
        $subscriber = Subscriber::where('email', $normalizedEmail)->first();

        if ($subscriber) {
            $isNew = false;
            // Update details if missing or reactivate if unsubscribed
            $subscriber->update([
                'name' => $subscriber->name ?: $name,
                'avatar' => $subscriber->avatar ?: $avatar,
                'ip_address' => $ip,
                'email_host' => $emailHost,
                'user_agent' => $userAgent,
                'status' => 'active',
                'subscribed_at' => $subscriber->subscribed_at ?: now(),
            ]);
        } else {
            $isNew = true;
            $subscriber = Subscriber::create([
                'email' => $normalizedEmail,
                'name' => $name,
                'avatar' => $avatar,
                'ip_address' => $ip,
                'email_host' => $emailHost,
                'user_agent' => $userAgent,
                'status' => 'active',
                'subscribed_at' => now(),
            ]);
        }

        $totalCount = Subscriber::where('status', 'active')->count();

        return [
            'success' => true,
            'is_new' => $isNew,
            'message' => $isNew 
                ? "You've successfully subscribed with {$normalizedEmail}!" 
                : "Welcome back! Your subscription is active.",
            'subscriber' => [
                'id' => $subscriber->id,
                'email' => $subscriber->email,
                'name' => $subscriber->display_name,
                'avatar' => $subscriber->avatar_url,
                'email_host' => $subscriber->email_host,
                'ip_address' => $subscriber->ip_address,
            ],
            'total_subscribers' => $totalCount,
        ];
    }

    /**
     * Determine client IP taking proxies and Cloudflare into account.
     */
    protected function getClientIp(Request $request): string
    {
        return $request->header('CF-Connecting-IP')
            ?? $request->header('X-Forwarded-For')
            ?? $request->ip()
            ?? '127.0.0.1';
    }

    /**
     * Resolve email domain and host (MX mail exchanger).
     */
    protected function resolveEmailHost(string $email): array
    {
        $domain = substr(strrchr($email, '@'), 1);
        $mxHosts = [];

        if (!empty($domain) && function_exists('getmxrr') && @getmxrr($domain, $mxHosts)) {
            $primaryMx = $mxHosts[0] ?? $domain;
            return [
                'domain' => $domain,
                'host' => strtolower($primaryMx),
            ];
        }

        return [
            'domain' => $domain ?: 'unknown',
            'host' => strtolower($domain ?: 'unknown'),
        ];
    }

    /**
     * Fetch user profile (name and avatar) from email host / Gravatar / local user records.
     */
    protected function fetchProfileFromEmailHost(string $email): array
    {
        $name = null;
        $avatar = null;

        // 1. Check if the email belongs to a registered User in database
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $name = $existingUser->name;
            if (!empty($existingUser->avatar)) {
                $avatar = str_starts_with($existingUser->avatar, 'http') 
                    ? $existingUser->avatar 
                    : asset($existingUser->avatar);
            }
        }

        // 2. Fetch from Gravatar profile API (Global email host avatar network)
        $md5Hash = md5($email);
        $gravatarAvatarUrl = "https://www.gravatar.com/avatar/{$md5Hash}?s=200&d=identicon";

        try {
            $response = Http::timeout(3)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Portfolio-App/1.0',
                    'Accept' => 'application/json',
                ])
                ->get("https://en.gravatar.com/{$md5Hash}.json");

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['entry'][0])) {
                    $entry = $data['entry'][0];
                    if (empty($name)) {
                        $name = $entry['displayName'] 
                            ?? ($entry['name']['formatted'] ?? null) 
                            ?? ($entry['preferredUsername'] ?? null);
                    }
                    if (empty($avatar)) {
                        if (!empty($entry['thumbnailUrl'])) {
                            $avatar = $entry['thumbnailUrl'];
                        } elseif (!empty($entry['photos'][0]['value'])) {
                            $avatar = $entry['photos'][0]['value'];
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::info("Gravatar lookup timed out or failed for {$email}: " . $e->getMessage());
        }

        // 3. Fallback avatar to email-deterministic Identicon URL
        if (empty($avatar)) {
            $avatar = $gravatarAvatarUrl;
        }

        // 4. Fallback name from email local-part
        if (empty($name)) {
            $local = explode('@', $email)[0] ?? 'subscriber';
            $cleaned = preg_replace('/[._+\-]+/', ' ', $local);
            $cleaned = preg_replace('/\d+$/', '', $cleaned);
            $name = ucwords(trim($cleaned));
            if (empty($name)) {
                $name = ucwords(explode('@', $email)[0] ?? 'Subscriber');
            }
        }

        return [
            'name' => $name,
            'avatar' => $avatar,
        ];
    }
}

