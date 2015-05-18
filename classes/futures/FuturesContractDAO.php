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
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "futures\FuturesContract");
        return $receivers;//!!!have to check if array exists
    }
}
