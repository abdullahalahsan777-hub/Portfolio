<?php

namespace App\Jobs;

use App\Mail\ServerDownMail;
use App\Mail\ServerUpMail;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class BroadcastServerStatusEmailJob
 *
 * Background queued job for broadcasting server status notifications (Live / Maintenance 503)
 * to registered users and administrative contacts.
 *
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatch(string $status, array $customDetails = [])
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatchSync(string $status, array $customDetails = [])
 * @method static \Illuminate\Foundation\Bus\PendingDispatch dispatchAfterResponse(string $status, array $customDetails = [])
 */
class BroadcastServerStatusEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $status;
    public array $customDetails;

    public int $tries = 3;
    public int $timeout = 300;

    /**
     * Create a new job instance.
     */
    public function __construct(string $status, array $customDetails = [])
    {
        $this->status = $status;
        $this->customDetails = $customDetails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::whereNotNull('email')->get();
        $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
        $contactEmail = SiteSetting::get('contact_email', config('mail.from.address', 'support@portfolio.local'));

        $sent = 0;
        $failed = 0;

        foreach ($users as $user) {
            try {
                if ($this->status === 'down') {
                    $details = array_merge([
                        'siteName' => $siteName,
                        'title' => SiteSetting::get('maintenance_title', 'System Upgrade in Progress'),
                        'noticeMessage' => SiteSetting::get('maintenance_message', 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes a scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.'),
                        'estimatedTime' => SiteSetting::get('maintenance_estimated_time', 'Estimated duration: 15–30 minutes'),
                        'startedAt' => now()->format('M d, Y • h:i A T'),
                        'statusUrl' => url('/errors/503'),
                        'contactEmail' => $contactEmail,
                    ], array_filter($this->customDetails));

                    Mail::to($user->email)->send(new ServerDownMail($user, $details));
                } else {
                    $details = array_merge([
                        'siteName' => $siteName,
                        'title' => 'System Restored & Live Online',
                        'noticeMessage' => 'All frontend portfolio themes, user dashboards, and application services are back online and operating normally at peak performance. Thank you for your patience while we upgraded our infrastructure!',
                        'restoredAt' => now()->format('M d, Y • h:i A T'),
                        'dashboardUrl' => route('login'),
                        'contactEmail' => $contactEmail,
                    ], array_filter($this->customDetails));

                    Mail::to($user->email)->send(new ServerUpMail($user, $details));
                }
                $sent++;
            } catch (\Throwable $e) {
                $failed++;
                Log::warning("Failed to deliver queued server {$this->status} email to [{$user->email}]: " . $e->getMessage());
            }
        }

        Log::info("BroadcastServerStatusEmailJob completed for status '{$this->status}'. Sent: {$sent}, Failed: {$failed}");
    }
}

