<?php

return [

    # Default API version to use
    'api_version' => env('API_VERSION', 'v1'),

    # Default user
    'admin_email' => env('ADMIN_EMAIL', 'mail@canary.test'),

    # App model settings
    'app' => [
        'name_length_min' => 6,
        'name_length_max' => 255,
        'uuid_validation' => '[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}',
    ],

    # Counter model settings
    'counter' => [
        'name_length_min' => 6,
        'name_length_max' => 255,
        'name_validation' => '[a-z0-9\-_\.]{6,255}',
    ],

    # Levels
    'levels' => [
        'emergency',
        'alert',
        'critical',
        'error',
        'warning',
        'notice',
        'info',
        'debug',
    ],

];
