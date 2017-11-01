<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Remote Server Locations
    |--------------------------------------------------------------------------
    |
    | This allows the collection and drop off points on the remote server to be specified in the config file.
    |
    */
    'credentials' => [
        'consumer_key'      => env('ZOEY_CONSUMER_KEY'),
        'consumer_secret'   => env('ZOEY_CONSUMER_SECRET'),
        'token'             => env('ZOEY_CONSUMER_TOKEN'),
        'token_secret'      => env('ZOEY_CONSUMER_TOKEN_SECRET'),
        'base_url'          => env('ZOEY_BASE_URL'),
    ],

    'product_extra_fields' => [
        //
    ],

];
