<?php
namespace receiver;
use PDO;
class ReceiverTrialDAO {
    public static function GetTrial(){
        $db= \dbase\Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM receivers WHERE fk_receiver_type = 2 AND active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "ReceiverTrial");
        return $receivers;//!!!have to check if array exists
    }
}
