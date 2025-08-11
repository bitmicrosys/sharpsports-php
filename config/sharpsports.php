<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SharpSports API Key
    |--------------------------------------------------------------------------
    |
    | Your SharpSports API key. You can get this from your SharpSports
    | dashboard. For security, it's recommended to store this in your
    | .env file as SHARPSPORTS_API_KEY.
    |
    */

    'api_key' => env('SHARPSPORTS_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Options
    |--------------------------------------------------------------------------
    |
    | Additional options to pass to the Guzzle HTTP client.
    | These options will be merged with the default options.
    |
    */

    'options' => [
        'timeout' => 30,
        'connect_timeout' => 10,
        // Add any other Guzzle options here
    ],
];