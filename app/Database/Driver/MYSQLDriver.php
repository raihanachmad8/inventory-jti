<?php

class MYSQLDriver implements DatabaseDriver
{
    private static ?PDO $connection = null;

    public static function connect($driver, $host, $port, $database, $username, $password) : PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO("$driver:host=$host;port=$port;dbname=$database", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
