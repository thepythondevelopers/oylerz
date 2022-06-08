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
    'stripe' => [
     'secret' => env('STRIPE_SECRET'),
 ],
  'google' => [
        'client_id' => '374285270805-b4ogr42s0ne3oar2ffs2djnlgnddr0ps.apps.googleusercontent.com',
        'client_secret' => 'cbcd311554cd0db81b1de3b687a751cb',
        'redirect' => 'https://oylerz.pamsar.com/auth/google/callback',
    ],
     'facebook' => [
        'client_id' => '759592375406497',
        'client_secret' => 'cbcd311554cd0db81b1de3b687a751cb',
        'redirect' => 'https://oylerz.pamsar.com/auth/facebook/callback',
    ],
];
