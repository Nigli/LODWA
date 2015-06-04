<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverDao {    
    public static function GetActiveReceivers(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_receiver,fk_receiver_type,receiver_type,first_name,last_name,email,active,date_added,na_number,broker_account "
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
        $res = $db->prepare("SELECT id_receiver,fk_receiver_type,first_name,last_name,email,active,date_added,na_number,broker_account "
                . "FROM receivers "
                . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                . "WHERE (fk_receiver_type=1 OR fk_receiver_type=2) AND active = 1");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
        return $receivers;//!!!have to check if exists
    }
    public static function GetClientsSubs($tr_prog,$num_contr){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT SUM(num_subs * :num_contr) as total_subs "
                . "FROM subscriptions "
                . "WHERE fk_strategy = :tr_prog LIMIT 1");
        $res->bindParam(':num_contr',$num_contr);
        $res->bindParam(':tr_prog',$tr_prog);
        $res->execute();
        $receivers = $res->fetchColumn();
        return $receivers;//!!!have to check if exists
    }
    public static function GetSubscribers($tr_prog){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT first_name, last_name, num_subs "
                . "FROM receivers "
                . "LEFT JOIN subscriptions ON fk_id_client=id_receiver "
                . "WHERE fk_strategy = :tr_prog");
        $res->bindParam(':tr_prog',$tr_prog);
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
        return $receivers;//!!!have to check if exists
    }
    public static function GetTypes(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM receiver_type");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_ASSOC);
        return $receivers;//!!!have to check if exists
    }    
    public static function NewReceiver($receiver){
        $db= Conn::GetConnection();            
        try{
            $rec = $db->prepare("INSERT INTO receivers "
                . "(id_receiver,fk_receiver_type,first_name,last_name,email,date_added) "
                . "VALUES('',:fk_receiver_type,:first_name,:last_name,:email,now())");
            $rec->bindParam(':fk_receiver_type',$receiver['type']);
            $rec->bindParam(':first_name',$receiver['first_name']);
            $rec->bindParam(':last_name',$receiver['last_name']);
            $rec->bindParam(':email',$receiver['email']);
            $rec->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
         try{   
            $lastid =  $db->lastInsertId();
            $cli = $db->prepare("INSERT INTO clients "
                . "(id_client,fk_id_receiver,na_number,broker_account) "
                . "VALUES('',".$lastid.",:na_number,:broker_account)");            
            $cli->bindParam(':na_number',$receiver['na_number']);
            $cli->bindParam(':broker_account',$receiver['broker_acc']);            
            $cli->execute();
            echo $lastid;
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UpdateReceiver($receiver){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE receivers "
                . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                . "SET fk_receiver_type=:fk_receiver_type, "
                    . "first_name=:first_name, "
                    . "last_name=:last_name, "
                    . "email=:email, "
                    . "na_number=:na_number, "
                    . "broker_account=:broker_account "
                . "WHERE id_receiver=:id_receiver");
            $res->bindParam(':id_receiver',$receiver['id_receiver']);
            $res->bindParam(':fk_receiver_type',$receiver['type']);
            $res->bindParam(':first_name',$receiver['first_name']);
            $res->bindParam(':last_name',$receiver['last_name']);
            $res->bindParam(':email',$receiver['email']);
            $res->bindParam(':na_number',$receiver['na_number']);
            $res->bindParam(':broker_account',$receiver['broker_acc']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UnsubscribeReceiver($receiver){
        $db= Conn::GetConnection();
        $res = $db->prepare("UPDATE receivers "
                . "SET active=0, "
                . "date_inactive=now() "
                . "WHERE id_receiver=:id");
        $res->bindParam(':id',$receiver['id_receiver']);
        $res->execute();
    }    
}
