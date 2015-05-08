<?php
namespace broker;
use PDO;
class BrokerDAO {    
    public static function GetBrokerInfo(){
        $db= \dbase\Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM broker_info");
        $res->execute();
        $broker_info = $res->fetch(PDO::FETCH_ASSOC);       
        return $broker_info;
    }
}
