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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'firebase' => [
        'api_key' => 'AIzaSyCP90awy18PadIJs6ihetSTzIfLjAU3E5U',
        'auth_domain' => 'placavision-43d14.firebaseapp.com',
        'database_url' => 'https://placavision-43d14-default-rtdb.firebaseio.com',
        'project_id' => 'placavision-43d14',
        'storage_bucket' => 'placavision-43d14.appspot.com',
        'messaging_sender_id' => '61424825675',
        'app_id' => '1:61424825675:web:48447a3ce94a216aa3a4ce',
        'measurement_id' => 'G-XMDV86GQD0' // Opcional, solo si tienes habilitado Analytics
    ],
    
    

];
