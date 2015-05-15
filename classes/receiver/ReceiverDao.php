<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverDao {    
    public static function GetActiveReceivers(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_receiver,fk_receiver_type,receiver_type,first_name,last_name,email,active,date_added,na_number,broker_account,any_account "
                . "FROM receivers "
                . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                . "WHERE active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
        return $receivers;//!!!have to check if exists
    }
    public static function GetInactiveReceivers(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_receiver,fk_receiver_type,first_name,last_name,email,active,date_added FROM receivers WHERE active = 0");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
        return $receivers;//!!!have to check if exists
    }
    public static function GetClientsReceivers(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_receiver,fk_receiver_type,first_name,last_name,email,active,date_added,na_number,rjo_account,any_account "
                . "FROM receivers "
                . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                . "WHERE (fk_receiver_type=1 OR fk_receiver_type=2) AND active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
        return $receivers;//!!!have to check if exists
    }
    public static function GetClientsSubs($tr_strat,$num_contr){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT SUM(num_subs * :num_contr) as total_subs "
                . "FROM subscriptions "
                . "WHERE fk_tr_strategy = :tr_strat");
        $res->bindParam(':num_contr',$num_contr);
        $res->bindParam(':tr_strat',$tr_strat);
        $res->execute();
        $receivers = $res->fetchColumn();
        return $receivers;//!!!have to check if exists
    }
    public static function DeactivateReceiver($id_receiver){
        $db= Conn::GetConnection();
        $res = $db->prepare("UPDATE receivers set active=0 WHERE id_receiver=:id");
        $res->bindParam(':id',$id_receiver);
        $res->execute();
    }
}