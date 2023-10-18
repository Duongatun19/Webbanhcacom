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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '1093082406314-kte0peobs5t1herh2v5bg7bm3eju6ov4.apps.googleusercontent.com',
        'client_secret' => 'kddh8TNTdRNxPaHNrO1JM8O6',
        'redirect' => 'https://jicafood.com/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '1032454740898097',
        'client_secret' => 'b5ebee4644ae5cff6952e39f3320fcdb',
        'redirect' => 'https://jicafood.com/auth/facebook/callback',
      ],

];
