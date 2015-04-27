<?php
class FuturesContractDAO {
    public static function GetFutures(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM futures_cont");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "FuturesContract");
        return $receivers;//!!!have to check if array exists
    }
}
