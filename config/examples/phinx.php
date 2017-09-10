<?php
return [
    'environments' => [
        'default_database' => 'default',

        'default' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'data',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ],
    'paths' => [
        'migrations' => 'database/migrations',
    ],
];