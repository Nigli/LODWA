<?php
namespace futures;
use PDO,utils\Conn;
class FuturesContractDAO {
    public static function GetFutures(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_futures,fk_tr_program,futures_name,description,dec_places,tr_program_name "
                . "FROM futures_cont "
                . "LEFT JOIN trade_program ON id_tr_program=fk_tr_program");
        $res->execute();
        $futures = $res->fetchAll(PDO::FETCH_CLASS, "futures\FuturesContract");
        return $futures;//!!!have to check if array exists
    }
    public static function GetFuturesById($futures_id){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_futures,fk_tr_program,futures_name,description,dec_places,tr_program_name "
                . "FROM futures_cont "
                . "LEFT JOIN trade_program ON id_tr_program=fk_tr_program "
                . "WHERE id_futures=:futures_id LIMIT 1");
        $res->bindParam(':futures_id',$futures_id);
        $res->execute();
        $futures = $res->fetchObject("futures\FuturesContract");;
        return $futures;//!!!have to check if array exists
    }
    
    public static function GetFuturesNames(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT  id_futures, futures_name FROM futures_cont");
        $res->execute();
        $futures = $res->fetchAll(PDO::FETCH_ASSOC);
        return $futures;//!!!have to check if array exists
    }
}
