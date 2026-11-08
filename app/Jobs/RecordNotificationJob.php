<?php

namespace App\Jobs;

use App\Events\NotificationCreated;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RecordNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Notification attributes payload.
     *
     * @var array
     */
    public array $attributes;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public int $maxExceptions = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $notification = Notification::create([
                'user_id'    => $this->attributes['user_id'] ?? null,
                'type'       => $this->attributes['type'] ?? 'general',
                'title'      => $this->attributes['title'] ?? 'Notification',
                'message'    => $this->attributes['message'] ?? '',
                'action_url' => $this->attributes['action_url'] ?? null,
                'icon'       => $this->attributes['icon'] ?? 'bell',
                'color'      => $this->attributes['color'] ?? 'indigo',
                'is_read'    => false,
                'read_at'    => null,
                'data'       => $this->attributes['data'] ?? null,
            ]);

            // Attempt broadcasting to real-time subscribers via queued event
            try {
                event(new NotificationCreated($notification));
            } catch (\Throwable $broadcastException) {
                Log::info('Queued notification broadcast skipped or non-critical: ' . $broadcastException->getMessage());
            }
        } catch (\Throwable $e) {
            Log::error('Failed to execute RecordNotificationJob: ' . $e->getMessage(), [
                'attributes' => $this->attributes,
            ]);
            throw $e;
        }
    }
}

