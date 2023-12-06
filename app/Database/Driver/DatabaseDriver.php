<?php

interface DatabaseDriver
{
    public static function connect($driver, $host, $port, $database, $username, $password);
    public static function close();

}
