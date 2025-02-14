<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_ID'),         // Your GitHub Client ID
        'client_secret' => env('FACEBOOK_SECRET'), // Your GitHub Client Secret
        'redirect' => env('APP_URL').'/auth/facebook/callback',
    ],

    'github' => [
        'client_id' => env('GITHUB_ID'),         // Your GitHub Client ID
        'client_secret' => env('GITHUB_SECRET'), // Your GitHub Client Secret
        'redirect' => env('APP_URL').'/auth/github/callback',
    ],

    'twitter' => [
        'client_id' => env('TWITTER_KEY'),         // Your GitHub Client ID
        'client_secret' => env('TWITTER_SECRET'), // Your GitHub Client Secret
        'redirect' => env('APP_URL').'/auth/twitter/callback',
    ],

    'google' => [
        'client_id' => env('GOOGLE_ID'),         // Your GitHub Client ID
        'client_secret' => env('GOOGLE_SECRET'), // Your GitHub Client Secret
        'redirect' => env('APP_URL').'/auth/google/callback',
    ],

];
