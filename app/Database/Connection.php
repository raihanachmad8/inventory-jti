<?php

require_once __DIR__ . "/Driver/DatabaseDriver.php";
require_once __DIR__ . "/Driver/MSSQLDriver.php";
require_once __DIR__ . "/Driver/MYSQLDriver.php";

class DB {
    private static $config = [];

    private static $databaseDriver;

    private static function init()
    {
        if (empty(self::$config)) {
            self::$config = require __DIR__ . "/../../config/database.php";
        }
    }
    public static function connect($connection = null)
    {
        self::init();
        $driver = self::$config['connections'][self::$config['default']]['driver'];
        $host = self::$config['connections'][self::$config['default']]['host'];
        $port = self::$config['connections'][self::$config['default']]['port'];
        $database = self::$config['connections'][self::$config['default']]['database'];
        $username = self::$config['connections'][self::$config['default']]['username'];
        $password = self::$config['connections'][self::$config['default']]['password'];
        if ($connection === 'mysql') {
            return MYSQLDriver::connect($driver, $host, $port, $database, $username, $password);
        } else if ($connection === 'mssql') {
            return MSSQLDriver::connect($driver, $host, $port, $database, $username, $password);
        }


        if ($driver == 'mssql') {
            self::$databaseDriver = MSSQLDriver::connect($driver, $host, $port, $database, $username, $password);
        } else if ($driver == 'mysql') {
            self::$databaseDriver = MYSQLDriver::connect($driver, $host, $port, $database, $username, $password);
        } else {
            throw new Exception("Driver not found");
        }
        return self::$databaseDriver;
    }

    public static function close()
    {
        self::$databaseDriver = null;
        if (self::$config['connections'][self::$config['default']]['driver'] == 'mssql') {
            MSSQLDriver::close();
        } else if (self::$config['connections'][self::$config['default']]['driver'] == 'mysql') {
            MYSQLDriver::close();
        }
    }
}
