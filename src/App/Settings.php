<?php

declare(strict_types=1);

return [
    'settings' => [
        'db' => [
            'hostname' => getenv('DB_HOST'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
        ],
    ],
];
