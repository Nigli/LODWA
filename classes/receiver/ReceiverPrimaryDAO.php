<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverPrimaryDAO {
    public static function GetPrimary(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * from receivers WHERE fk_receiver_type = 1 AND active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\ReceiverPrimary");
        return $receivers;//!!!have to check if array exists
    }    
}
