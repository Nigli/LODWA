<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverFandFDAO {
    public static function GetFandF(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM receivers WHERE fk_receiver_type = 3 AND active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\ReceiverFandF");
        return $receivers;//!!!have to check if array exists
    }
    public static function GetFandFId($id){
        $db= \Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM receivers WHERE id_receiver=:id LIMIT 1");
        $res->bindParam(':id',$id);        
        $res->execute();
        $res->setFetchMode(PDO::FETCH_CLASS, "receiver\ReceiverFandF");
        $receivers = $res->fetch();
        return $receivers;//!!!have to check if it exists
    }
}
