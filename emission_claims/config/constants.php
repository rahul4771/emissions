<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables
    |--------------------------------------------------------------------------
    |
    | This is a set of variables that are made specific to this application
    | that are better placed here rather than in .env file.
    | Use config( 'your_key' ) to get the values.
    |
    */

    'title_array' => env( 'titles', [
        'Mr'      => 'Mr.',
        'Mrs'     => 'Mrs.',
        'Ms'      => 'Ms.',
        'Dr'      => 'Dr.',
        'Prof'    => 'Prof.'
    ] ),
    'title_array_female' => env( 'titles_female', [
        'Mrs'      => 'Mrs',
        'Miss'     => 'Miss',
        'Ms'       => 'Ms',
        'Lady'     => 'Lady'
    ] ),

    'month_array' => env( 'months', [
        '1'       => 'January',
        '2'       => 'February',
        '3'       => 'March',
        '4'       => 'April',
        '5'       => 'May',
        '6'       => 'June',
        '7'       => 'July',
        '8'       => 'August',
        '9'       => 'September',
        '10'      => 'October',
        '11'      => 'November',
        '12'      => 'December'
    ]),
    'DATA_KEY_TEST'         => 'I_FDB2EE55108844839FFCBE20CC5231',
    'DATA_KEY_LIVE'         => 'W_FDB2EE55108844839FFCBE20CC5231',
    'DATA8_USERNAME'        => 'tia123',
    'DATA8_PASSWORD'        => 'Bojangles0469',
    'VU_SEPARATOR'          => '_=_',

    // Define Cake params
    'CAKE_CAMPAIGN_ID'      => '4365',
    'CAKE_CKM_KEY'          => 'EzyUaMm7TrQ',

    'CAKE_CAMPAIGN_ID_TEST' => '4364',
    'CAKE_CKM_KEY_TEST'     => 'xb6XbREJGbc',
    'log_path'              => base_path().'/storage/logs/',
    'live_log_path'         => '/mnt/nfs/logs/mbemissionsclaim.co.uk',
    'TOKEN'                 => '5af58567cd4990228fed126274b3ab4b769390ac1dbde073ecf5b6c0aa3feb01',
    'TO_EMAIL_ADDRESS'      => "developers@vandalayglobal.com",
    'FROM_EMAIL_ADDRESS'    => "info@the-debt-exchange.co.uk",
    'SITE_NAME'             => "the-debt-exchange.co.uk",
    //Api token
    'AUTH_API_TOKEN'        => env('AUTH_API_TOKEN','5af58567cd4990228fed126274b3ab4b769390ac1dbde073ecf5b6c0aa3feb01'),
    'VEHICLE_DATA_KEY'      => '9a0c3e8c-d2d1-4adf-ae59-d609e4702dc7',

    'vehicle_class' => env( 'vehicle_class', [
        'A-CLASS'       => 'A-CLASS',
        'B-CLASS'       => 'B-CLASS',
        'C-CLASS'       => 'C-CLASS',
        'CLA'           => 'CLA',
        'CITAN'         => 'CITAN',
        'CLS CLASS'     => 'CLS CLASS',
        'E-CLASS'       => 'E-CLASS',
        'G-CLASS'       => 'G-CLASS',
        'GLC'           => 'GLC',
        'GLE'           => 'GLE',
        'GLK'           => 'GLK',
        'GLS 350D'      => 'GLS 350D',
        'M CLASS'       => 'M CLASS',
        'ML'            => 'ML',
        'S-CLASS'       => 'S-CLASS',
        'SLK'           => 'SLK',
        'SPRINTER'      => 'SPRINTER',
        'V-CLASS'       => 'V-CLASS',
        'VITO'          => 'VITO',
        'Other'         => 'Other'
    ] ),
];