<?php


class MSSQLDriver
{
    private static ?PDO $connection = null;

    public static function connect($driver, $host, $port, $database, $username, $password) : PDO
    {
        if (!self::$connection) {
            try {
                self::$connection = new PDO("$driver:Server=$host,$port;Database=$database", $username, $password);
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
