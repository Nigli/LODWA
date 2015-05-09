<?php
namespace sender;
use PDO,utils\Conn;
class SenderInfoDAO {
    public static function GetSenderInfo(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM sender_info");
        $res->execute();
        $sender_info = $res->fetch(PDO::FETCH_ASSOC);       
        return $sender_info;
    }
}
