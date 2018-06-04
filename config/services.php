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

    'google'   => [
        'client_id'     => '68734308462-nd485cvd0uldklboab9rogoosaornrtr.apps.googleusercontent.com',
        'client_secret' => 'pafraRaxeXwpwj3BIlWCnsqU',
        'redirect'      => 'http://localhost:8000/login/google/callback',
    ],

    'facebook'   => [
        'client_id'     => '2081066672160908',
        'client_secret' => 'ba71ca0939c351948401812fe406eaee',
        'redirect'      => 'http://localhost:8000/login/facebook/callback',
    ]

];
