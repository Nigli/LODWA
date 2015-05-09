<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverTrialDAO {
    public static function GetTrial(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM receivers WHERE fk_receiver_type = 2 AND active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\ReceiverTrial");
        return $receivers;//!!!have to check if array exists
    }
}
