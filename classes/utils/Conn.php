<?php

namespace utils;

use PDO;

class Conn {

    /* localhost wamp */
    const DBUSER = "root";
    const DBPASS = "";
    const DBHOST = "localhost";
    const DB = "lodwa";

    public static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:dbhost=" . self::DBHOST . ";dbname=" . self::DB . ";charset=UTF8", self::DBUSER, self::DBPASS);
            } catch (\PDOException $e) {
                Conn::logConnectionErr($e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function logConnectionErr($e) {
        $time = date("Y-m-d H:i:s");
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $log = $time . "|" . $ip_address . "|" . $e . "\n";
        file_put_contents("log/errors/connlogerr.txt", $log, FILE_APPEND | LOCK_EX);
        return FALSE;
    }

}
