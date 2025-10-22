<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default init base directory
    |
    */
    'project_name' => 'base_laravel',
    'php_version' => '8.3',
    'mysql_version' => '8.0',

    'path' => 'app/Repositories',
    'service_path' => 'app/Services',

    /*
     * Default repository namespace
     */
    'namespace' => 'App\Repositories',

    'service_namespace' => 'App\Services',

    'naming' => 'singular', // plural | singular

    'response' => [
        'headers' => [
            'Content-Type' => 'application/json,charset=UTF-8',
            'Access-Control-Allow-Credentials' => 'TRUE',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, DELETE, PUT, PATCH',
            'Access-Control-Allow-Headers' => 'x-requested-with',
            'Access-Control-Max-Age' => '864,000',
        ],
    ],
];
