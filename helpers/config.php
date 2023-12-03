<?php

function env($key, $default = null, $environment = null)
{
    $envPath = __DIR__ . "/../.env" . ($environment ? "." . $environment : "");
    $env = file_exists($envPath) ? parse_ini_file($envPath) : [];

    if (array_key_exists($key, $env)) {
        return $env[$key];
    }

    return $default;
}
