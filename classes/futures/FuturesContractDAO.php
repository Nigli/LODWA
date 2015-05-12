<?php
namespace futures;
use PDO,utils\Conn;
class FuturesContractDAO {
    public static function GetFutures(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM futures_cont");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "futures\FuturesContract");
        return $receivers;//!!!have to check if array exists
    }
}