<?php
namespace sender;
use PDO;
class SenderInfoDAO {
    public static function GetSenderInfo(){
        $db= \dbase\Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM sender_info");
        $res->execute();
        $sender_info = $res->fetch(PDO::FETCH_ASSOC);       
        return $sender_info;
    }
}
