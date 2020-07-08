<?php
return [
    'path' => 'ads',
    'middleware' => 'auth:api',
    'page_limit' => 30,
    'driver' => 'file',
    'file' => [
        'type' => 'csv',
        'path' => 'storage/app/realestate/data'
    ],
    'database' => [
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'password',
        'database_name' => 'old_real_estate',
    ],
];