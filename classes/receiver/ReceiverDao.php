<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverDao {    
    public static function GetReceivers($pagin,$filter){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_receiver,fk_receiver_type,receiver_type,first_name,last_name,email,active,date_added,hash_email,na_number,broker_account "
                    . "FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                    . "WHERE active = if(:active= 'ALL',active, :active) "
                    . "AND fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND broker_account= if(:broker_account= 'ALL',broker_account, :broker_account) "
                    . "LIMIT :limit "
                    . "OFFSET :offset");
            $res->bindParam(':limit',$pagin->limit, PDO::PARAM_INT);
            $res->bindParam(':offset',$pagin->offset, PDO::PARAM_INT); 
            $res->bindParam(':type',$filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_account',$filter['ba'], PDO::PARAM_STR);
            $res->bindParam(':active',$filter['active'], PDO::PARAM_STR);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }            
    public static function GetReceiverById($id){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_receiver,fk_receiver_type,receiver_type,first_name,last_name,email,active,hash_email,date_added,na_number,broker_account "
                    . "FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                    . "WHERE id_receiver = :id_receiver "
                    . "LIMIT 1");        
            $res->bindParam(':id_receiver',$id);
            $res->execute();
            $receivers = $res->fetchObject("receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetReceiverByHash($hash_email){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_receiver,fk_receiver_type,receiver_type,first_name,last_name,email,active,hash_email,date_added,na_number,broker_account "
                    . "FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                    . "WHERE hash_email = :hash_email "
                    . "LIMIT 1");
            $res->bindParam(':hash_email',$hash_email);
            $res->execute();
            $receivers = $res->fetchObject("receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetClientsReceivers(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_receiver,fk_receiver_type,first_name,last_name,email,active,date_added,hash_email,na_number,broker_account "
                    . "FROM receivers "
                    . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                    . "WHERE (fk_receiver_type=1 OR fk_receiver_type=2) AND active = 1");
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetClientsSubs($tr_prog,$num_contr){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT SUM(num_subs * :num_contr) as total_subs "
                    . "FROM subscriptions "
                    . "WHERE fk_strategy = :tr_prog LIMIT 1");
            $res->bindParam(':num_contr',$num_contr);
            $res->bindParam(':tr_prog',$tr_prog);
            $res->execute();
            $receivers = $res->fetchColumn();
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetSubscribersByStrategy($tr_prog){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT first_name, last_name, num_subs "
                    . "FROM receivers "
                    . "LEFT JOIN subscriptions ON fk_id_client=id_receiver "
                    . "WHERE fk_strategy = :tr_prog");
            $res->bindParam(':tr_prog',$tr_prog);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetTypes(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT * FROM receiver_type");
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_ASSOC);
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    } 
    public static function CountReceivers($filter){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT COUNT(*) FROM receivers "
                    . "LEFT JOIN clients ON id_receiver=fk_id_receiver "
                    . "WHERE fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND broker_account= if(:broker_account = 'ALL',broker_account, :broker_account) "
                    . "AND active = if(:active= 'ALL',active, :active)");        
            $res->bindParam(':type',$filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_account',$filter['ba'], PDO::PARAM_STR);
            $res->bindParam(':active',$filter['active'], PDO::PARAM_STR);
            $res->execute();
            $receivers = $res->fetchColumn();
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function NewReceiver($receiver){
        $db= Conn::GetConnection();        
        try{
            $rec = $db->prepare("INSERT INTO receivers "
                . "(id_receiver,fk_receiver_type,first_name,last_name,email,date_added,hash_email) "
                . "VALUES('',:fk_receiver_type,:first_name,:last_name,:email,now(),md5(:email))");
            $rec->bindParam(':fk_receiver_type',$receiver['type']);
            $rec->bindParam(':first_name',$receiver['first_name']);
            $rec->bindParam(':last_name',$receiver['last_name']);
            $rec->bindParam(':email',$receiver['email']);
            $rec->execute();
        }catch(\PDOException $e){
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
            return TRUE;
        }catch(\PDOException $e){
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
            $res->bindParam(':id_receiver',$receiver['id_receiver'], PDO::PARAM_INT);
            $res->bindParam(':fk_receiver_type',$receiver['type'], PDO::PARAM_INT);
            $res->bindParam(':first_name',$receiver['first_name'], PDO::PARAM_STR);
            $res->bindParam(':last_name',$receiver['last_name'], PDO::PARAM_STR);
            $res->bindParam(':email',$receiver['email'], PDO::PARAM_STR);
            $res->bindParam(':na_number',$receiver['na_number'], PDO::PARAM_STR);
            $res->bindParam(':broker_account',$receiver['broker_acc'], PDO::PARAM_INT);
            $res->execute();
            return TRUE;
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UnsubscribeReceiver($receiver){
        $db= Conn::GetConnection();               
        try{
            $res = $db->prepare("UPDATE receivers "
                    . "SET active = if(:active=1, 0, 1), "
                    . "date_inactive=now() "
                    . "WHERE id_receiver=:id");
            $res->bindParam(':id',$receiver['id_receiver'], PDO::PARAM_INT);
            $res->bindParam(':active',$receiver['active'], PDO::PARAM_INT);
            $res->execute();  
            return TRUE;      
        }catch(\PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}
