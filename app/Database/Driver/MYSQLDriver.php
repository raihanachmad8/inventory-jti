<?php

class MYSQLDriver implements DatabaseDriver
{
    private static ?PDO $connection = null;
    private static array $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    public static function connect($driver, $host, $port, $database, $username, $password) : PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO("$driver:host=$host;port=$port;dbname=$database", $username, $password, self::$options);
            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function close()
    {
        self::$connection = null;
    }

}
