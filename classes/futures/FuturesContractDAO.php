<?php
namespace futures;
use PDO;
class FuturesContractDAO {
    public static function GetFutures(){
        $db= \dbase\Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM futures_cont");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "FuturesContract");
        return $receivers;//!!!have to check if array exists
    }
}
