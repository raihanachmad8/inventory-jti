<?php

return [
    "default" => env("DB_ENV", "mysql"),
    "connections" => [
        "mysql" => [
            "driver" => env("DB_DRIVER", "mysql"),
            "host" => env("DB_HOST", "localhost"),
            "port" => env("DB_PORT", "3306"),
            "database" => env("DB_DATABASE", "database"),
            "username" => env("DB_USER", "root"),
            "password" => env("DB_PASSWORD", "root"),
        ],
        "mssql" => [
            "driver" => env("DB_MSSQL_DRIVER", "sqlsrv"),
            "host" => env("DB_MSSQL_HOST", "localhost"),
            "port" => env("DB_MSSQL_PORT", "1433"),
            "database" => env("DB_MSSQL_DATABASE", "database"),
            "username" => env("DB_MSSQL_USER", "sa"),
            "password" => env("DB_MSSQL_PASSWORD", "root"),
        ]
    ]
];

