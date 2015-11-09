<?php

namespace utils;

use PDO;
class Conn {

    public static $conn;

    public static function getConnection() {
        if (HOST == 'lodwa.dev') {
            /* localhost wamp */
            $dbuser = "root";
            $dbpass = "";
            $dbhost = "localhost";
            $db = "lodwa";
        } else {
            
           
        }
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:dbhost=" . $dbhost . ";dbname=" . $db . ";charset=UTF8", $dbuser, $dbpass);
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
