<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY', null),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY', null),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID', null),
        'secret' => env('AWS_SECRET_ACCESS_KEY', null),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN', null),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL', null),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => (!empty(env('GOOGLE_REDIRECT_URI')) && !str_contains(env('GOOGLE_REDIRECT_URI'), '${'))
            ? env('GOOGLE_REDIRECT_URI')
            : (env('APP_URL', 'http://127.0.0.1:8044') . '/auth/google/callback'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => (!empty(env('FACEBOOK_REDIRECT_URI')) && !str_contains(env('FACEBOOK_REDIRECT_URI'), '${'))
            ? env('FACEBOOK_REDIRECT_URI')
            : (env('APP_URL', 'http://127.0.0.1:8044') . '/auth/facebook/callback'),
    ],

];
