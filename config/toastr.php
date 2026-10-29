<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dark Mode Toastr Palette & Design Tokens
    |--------------------------------------------------------------------------
    |
    | Deep obsidian glassmorphic palette for notifications across all environments.
    |
    */
    'palette' => [
        // Dark Base & Surfaces
        'dark_bg'         => '#0b1120',
        'dark_card'       => 'rgba(11, 17, 32, 0.96)',
        'text_title'      => '#f8fafc',
        'text_body'       => '#e2e8f0',
        'border'          => 'rgba(255, 255, 255, 0.1)',
        'accent'          => 'rgba(255, 255, 255, 0.08)',

        // Status Accents
        'success'         => '#34d399',
        'warning'         => '#fbbf24',
        'danger'          => '#f87171',
        'error'           => '#fb7185',
        'info'            => '#60a5fa',
        'important'       => '#c084fc',
    ],

    /*
    |--------------------------------------------------------------------------
    | Toastr Global Options
    |--------------------------------------------------------------------------
    |
    | Global options controlling animation, positioning, and dismiss behaviors.
    |
    */
    'options' => [
        'closeButton'      => true,
        'debug'            => false,
        'newestOnTop'      => true,
        'progressBar'      => true,
        'positionClass'    => 'toast-top-right',
        'preventDuplicates'=> false,
        'showDuration'     => '300',
        'hideDuration'     => '1000',
        'timeOut'          => '5000',
        'extendedTimeOut'  => '1500',
        'showEasing'       => 'swing',
        'hideEasing'       => 'linear',
        'showMethod'       => 'fadeIn',
        'hideMethod'       => 'fadeOut',
        'escapeHtml'       => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Configured Toast Types: Success, Warning, danger, error, info, Important
    |--------------------------------------------------------------------------
    |
    | Every status has its separated dark background, text, accent colors, and timeout.
    |
    */
    'types' => [
        'success' => [
            'name'         => 'Success',
            'title'        => 'Success',
            'class'        => 'toast-success',
            'title_color'  => '#34d399',
            'text_color'   => '#e2e8f0',
            'status_color' => '#10b981',
            'background'   => 'linear-gradient(135deg, rgba(6, 32, 22, 0.96) 0%, rgba(4, 20, 14, 0.98) 60%, rgba(2, 12, 8, 0.99) 100%)',
            'border'       => '1px solid rgba(52, 211, 153, 0.4)',
            'timeOut'      => 5000,
        ],
        'warning' => [
            'name'         => 'Warning',
            'title'        => 'Warning',
            'class'        => 'toast-warning',
            'title_color'  => '#fbbf24',
            'text_color'   => '#e2e8f0',
            'status_color' => '#f59e0b',
            'background'   => 'linear-gradient(135deg, rgba(40, 24, 4, 0.96) 0%, rgba(26, 15, 2, 0.98) 60%, rgba(14, 8, 1, 0.99) 100%)',
            'border'       => '1px solid rgba(245, 158, 11, 0.4)',
            'timeOut'      => 6000,
        ],
        'danger' => [
            'name'         => 'danger',
            'title'        => 'Danger',
            'class'        => 'toast-danger',
            'title_color'  => '#f87171',
            'text_color'   => '#e2e8f0',
            'status_color' => '#ef4444',
            'background'   => 'linear-gradient(135deg, rgba(45, 10, 15, 0.96) 0%, rgba(28, 5, 8, 0.98) 60%, rgba(16, 2, 4, 0.99) 100%)',
            'border'       => '1px solid rgba(239, 68, 68, 0.45)',
            'timeOut'      => 6000,
        ],
        'error' => [
            'name'         => 'error',
            'title'        => 'Error',
            'class'        => 'toast-error',
            'title_color'  => '#fb7185',
            'text_color'   => '#e2e8f0',
            'status_color' => '#f43f5e',
            'background'   => 'linear-gradient(135deg, rgba(45, 10, 22, 0.96) 0%, rgba(28, 5, 13, 0.98) 60%, rgba(16, 2, 7, 0.99) 100%)',
            'border'       => '1px solid rgba(244, 63, 94, 0.4)',
            'timeOut'      => 6000,
        ],
        'info' => [
            'name'         => 'info',
            'title'        => 'Notice',
            'class'        => 'toast-info',
            'title_color'  => '#60a5fa',
            'text_color'   => '#e2e8f0',
            'status_color' => '#3b82f6',
            'background'   => 'linear-gradient(135deg, rgba(10, 24, 52, 0.96) 0%, rgba(6, 14, 34, 0.98) 60%, rgba(3, 7, 20, 0.99) 100%)',
            'border'       => '1px solid rgba(59, 130, 246, 0.4)',
            'timeOut'      => 5000,
        ],
        'important' => [
            'name'         => 'Important',
            'title'        => 'Important Notice',
            'class'        => 'toast-important',
            'title_color'  => '#c084fc',
            'text_color'   => '#e2e8f0',
            'status_color' => '#8b5cf6',
            'background'   => 'linear-gradient(135deg, rgba(35, 12, 58, 0.96) 0%, rgba(20, 6, 36, 0.98) 60%, rgba(11, 3, 20, 0.99) 100%)',
            'border'       => '1px solid rgba(139, 92, 246, 0.4)',
            'timeOut'      => 8000,
        ],
    ],
];
