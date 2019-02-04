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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => '1c50d663402de25bf82d',
        'client_secret' => '88187e480497f3a4dda28e47488ba6f727c382a7',
        'redirect' => 'http://127.0.0.1:8000/auth/github/callback',
    ],

    'linkedin' => [
        'client_id' => '77y0e7ohm7ukvr',
        'client_secret' => 'SN3WOyKgF6ham9Xq',
        'redirect' => 'http://127.0.0.1:8000/auth/linkedin/callback',
    ],

];
