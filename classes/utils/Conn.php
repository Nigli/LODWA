<?php

namespace utils;

use PDO,
    utils\Session;

class Conn {
    /* srlevel.com on levantcap hosting */

//    const DBUSER = "lodwa";
//    const DBPASS = "Ha18Bd#484";
//    const DBHOST = "lodwa.db.6980776.hostedresource.com";
//    const DB = "lodwa";

    /* nigli.in.rs on 2freehosting */
//    const DBUSER = "u513348009_lodwa";
//    const DBPASS = "ICWq6#xx";
//    const DBHOST = "mysql.2freehosting.com:3307";
//    const DB = "u513348009_lodwa";   

    /* srlevel.com on srlevel.com hosting */
//    const DBUSER = "lodwp";
//    const DBPASS = "!fK)hQgwHkry";
//    const DBHOST = "lodwa.db.6980776.hostedresource.com";
//    const DB = "lodwp";

    /* localhost wamp */
    const DBUSER = "root";
    const DBPASS = "";
    const DBHOST = "localhost";
    const DB = "lodwp";

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
