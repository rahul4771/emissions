<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Authentication 
    |--------------------------------------------------------------------------
    |
    | This option controls the  authentication "guard" and password
    | your application.
    |
    */

    'use' => 'default',


    'prefix' => env('TELESCOPEAUTH_PREFIX', 'telescopeauth:'),

    /*
    |--------------------------------------------------------------------------
    | Telescope Route Middleware
    |--------------------------------------------------------------------------
    |
    */

    'middleware' => ['web', 'teleAuth'],

    

    'basic_auth' => [
        'username' => env('TELESCOPE_AUTH_USERNAME'),
        'password' => env('TELESCOPE_AUTH_PASSWORD'),
    ],





];
