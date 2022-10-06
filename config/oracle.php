<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => '(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 12.123.28.8)(PORT = 1521)) (CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = orcl.localdomain)))',
        'host'           => env('DB_HOST_ORA', ''),
        'port'           => env('DB_PORT_ORA', '1521'),
        'database'       => env('DB_DATABASE_ORA', ''),
        'username'       => env('DB_USERNAME_ORA', ''),
        'password'       => env('DB_PASSWORD_ORA', ''),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ]
];

