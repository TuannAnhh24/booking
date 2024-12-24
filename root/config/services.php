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

    'storage_image_disk_advisor' => env('STORAGE_IMAGE_DISK_ADVISOR', 'advisor/office/'),
    'storage_image_disk_admin' => env('STORAGE_IMAGE_DISK_ADMIN', 'admin/announcement/'),
    'storage_image_disk_provider' => env('STORAGE_IMAGE_DISK_PROVIDER', 'provider/office/'),

    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
    ],
];
