<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class FlashNotifier
{
    /**
     * Flash a general or custom-leveled message.
     *
     * @param string $message
     * @param string $level Config type: success, warning, danger, error, info, important
     * @param string|null $title
     * @return $this
     */
    public function message(string $message, string $level = 'info', ?string $title = null): self
    {
        $normalizedLevel = strtolower($level);

        // Normalize aliases to our 6 core configured types: success, warning, danger, error, info, important
        $allowedLevels = ['success', 'warning', 'danger', 'error', 'info', 'important'];

        if ($normalizedLevel === 'warn') {
            $normalizedLevel = 'warning';
        } elseif ($normalizedLevel === 'delete' || $normalizedLevel === 'deleted' || $normalizedLevel === 'destroy') {
            $normalizedLevel = 'danger';
        } elseif (! in_array($normalizedLevel, $allowedLevels, true)) {
            $normalizedLevel = 'info';
        }

        $defaultTitles = [
            'success'   => 'Success',
            'warning'   => 'Warning',
            'danger'    => 'Danger',
            'error'     => 'Error',
            'info'      => 'Notice',
            'important' => 'Important Notice',
        ];

        $finalTitle = $title ?? ($defaultTitles[$normalizedLevel] ?? ucfirst($normalizedLevel));

        // Flash to session keys
        Session::flash($normalizedLevel, $message);
        Session::flash("flash_{$normalizedLevel}", $message);

        Session::flash('flash_notification.message', $message);
        Session::flash('flash_notification.level', $normalizedLevel);
        Session::flash('flash_notification.title', $finalTitle);

        $existing = Session::get('toastr_notifications', []);
        $existing[] = [
            'type'    => $normalizedLevel,
            'message' => $message,
            'title'   => $finalTitle,
        ];
        Session::flash('toastr_notifications', $existing);

        return $this;
    }

    /**
     * Flash a Success message.
     */
    public function success(string $message, ?string $title = null): self
    {
        return $this->message($message, 'success', $title);
    }

    /**
     * Flash a Warning message.
     */
    public function warning(string $message, ?string $title = null): self
    {
        return $this->message($message, 'warning', $title);
    }

    /**
     * Flash a Danger message (e.g. destructive actions, deletions, high alerts).
     */
    public function danger(string $message, ?string $title = null): self
    {
        return $this->message($message, 'danger', $title);
    }

    /**
     * Flash a Deletion message mapped to the configured 'danger' status (or another valid status).
     *
     * @param string $message
     * @param string $level Config status: danger, warning, success, error, info, important
     * @param string|null $title
     * @return $this
     */
    public function delete(string $message, string $level = 'danger', ?string $title = null): self
    {
        return $this->message($message, $level, $title ?? 'Deleted');
    }

    /**
     * Flash an Error message.
     */
    public function error(string $message, ?string $title = null): self
    {
        return $this->message($message, 'error', $title);
    }

    /**
     * Flash an Info message.
     */
    public function info(string $message, ?string $title = null): self
    {
        return $this->message($message, 'info', $title);
    }

    /**
     * Flash an Important message or mark current toast as important.
     */
    public function important(?string $message = null, ?string $title = null): self
    {
        if (! is_null($message)) {
            return $this->message($message, 'important', $title);
        }

        Session::flash('flash_notification.important', true);

        return $this;
    }

    /**
     * Flash an overlay modal or high-priority notice.
     */
    public function overlay(string $message, string $title = 'Notice'): self
    {
        Session::flash('flash_notification.overlay', true);
        Session::flash('flash_notification.title', $title);

        return $this->message($message, 'important', $title);
    }

    /**
     * Magic caller for dynamic types (e.g., flash()->Success('...'), flash()->Important('...'))
     */
    public function __call(string $method, array $arguments): self
    {
        $normalized = strtolower($method);
        $message = $arguments[0] ?? '';
        $title = $arguments[1] ?? null;

        return $this->message($message, $normalized, $title);
    }
}
