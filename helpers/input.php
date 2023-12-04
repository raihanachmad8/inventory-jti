<?php
require_once __DIR__ . '/../app/Database/Connection.php';

class input {
    public static function get($name, bool $encoded = false) {
        if (isset($_GET[$name])) {
            if ($encoded) {
                return urldecode(self::sanitize($_GET[$name]));
            } else {
                return self::sanitize($_GET[$name]);
            }
        }
        return null;

    }

    public static function post($name) {
        if (isset($_POST[$name])) {
            return self::sanitize($_POST[$name]);
        }
        return null;
    }

    public static function file($name) {
        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        }
        return null;
    }

    public static function has($name) {
        if (isset($_REQUEST[$name])) {
            return true;
        }
        return false;
    }
    private static function sanitize($value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }
}
