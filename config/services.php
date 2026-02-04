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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'easytaxi' => [
        'base_url'        => env('EASYTAXI_BASE_URL'),
        'site_key'        => env('EASYTAXI_SITE_KEY'),

        'booking_widget' => env('EASYTAXI_BASE_URL') . '/booking/widget?site_key=' . env('EASYTAXI_SITE_KEY'),
        'booking_page'   => env('EASYTAXI_BASE_URL') . '/booking?site_key=' . env('EASYTAXI_SITE_KEY'),
        'customer_page'  => env('EASYTAXI_BASE_URL') . '/customer?site_key=' . env('EASYTAXI_SITE_KEY'),
        'iframe_resizer' => env('EASYTAXI_BASE_URL') . '/assets/plugins/iframe-resizer/iframeResizer.min.js',

        'iframe_resizer' => env('EASYTAXI_BASE_URL') . env('EASYTAXI_IFRAME_RESIZER'),
    ],



];
