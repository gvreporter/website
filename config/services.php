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
        'client_id' => env('GOOGLE_OAUTH_CLIENTID'),
        'client_secret' => env('GOOGLE_OAUTH_SECRET'),
        // About the redirect:
        // For some reason google oauth doesn't accept .test domains, even if in test mode.
        // So I made a small express server to redirect all the request from http://localhost/gvreporter_gcallback
        // to http://gvreporter.test/oauth/callback
        // Thanks Google.
        'redirect' => env('GOOGLE_OAUTH_REDIRECT', 'http://localhost:8083/gvreporter_gcallback'),
    ],

];
