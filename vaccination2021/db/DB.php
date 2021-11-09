<?php
namespace db;

class DB {

    private static $db = null;

    private function __construct() {}

    public static function get(){
        if (self::$db == null) {
            self::$db = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        } 
        return self::$db;
    }
}

