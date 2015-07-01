<?php
namespace receiver;
use PDO,utils\Conn;
class ReceiverDao {    
    public static function getReceivers($pagin,$filter){
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE active = :active "
                    . "AND fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND fk_strategy = if(:strategy= 0,fk_strategy, :strategy) "
                    . "AND broker_account= if(:broker_account= 'ALL',broker_account, :broker_account) "
                    . "GROUP BY id_receiver "
                    . "LIMIT :limit "
                    . "OFFSET :offset");
            $res->bindParam(':limit',$pagin->limit, PDO::PARAM_INT);
            $res->bindParam(':offset',$pagin->offset, PDO::PARAM_INT); 
            $res->bindParam(':type',$filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_account',$filter['ba'], PDO::PARAM_STR);
            $res->bindParam(':strategy',$filter['strategy'], PDO::PARAM_INT);
            $res->bindParam(':active',$filter['active'], PDO::PARAM_INT);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }            
    public static function getReceiverById($id){
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE id_receiver = :id_receiver "
                    . "LIMIT 1");        
            $res->bindParam(':id_receiver',$id);
            $res->execute();
            $receivers = $res->fetchObject("receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
    public static function getReceiverByHash($hash_email){
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE hash_email = :hash_email "
                    . "LIMIT 1");
            $res->bindParam(':hash_email',$hash_email);
            $res->execute();
            $receivers = $res->fetchObject("receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
    public static function getReceiversByStrat($tr_prog){/**GET ALL CLIENTS BY STRATEGY - RETURN ARRAY OF OBJECTS**/
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE (fk_receiver_type=1 OR fk_receiver_type=2) AND active = 1 AND fk_strategy = :tr_prog");
            $res->bindParam(':tr_prog',$tr_prog);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
    public static function getTypes(){
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT * FROM receiver_type");
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_ASSOC);
            return $receivers;//!!!have to check if exists
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    } 
    public static function countReceivers($filter){
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT COUNT(DISTINCT id_receiver) FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE active = :active "
                    . "AND fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND fk_strategy = if(:strategy= 0,fk_strategy, :strategy) "
                    . "AND broker_account= if(:broker_account= 'ALL', broker_account, :broker_account)");
            $res->bindParam(':type',$filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_account',$filter['ba'], PDO::PARAM_STR);
            $res->bindParam(':strategy',$filter['strategy'], PDO::PARAM_INT);
            $res->bindParam(':active',$filter['active'], PDO::PARAM_INT);
            $res->execute();
            $receivers = $res->fetchColumn();
            return $receivers;
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
    public static function newReceiver($receiver){
        $db= Conn::getConnection();    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        try{
            $rec = $db->prepare("INSERT INTO receivers "
                . "(id_receiver,fk_receiver_type,first_name,last_name,email,date_added,hash_email,na_number,broker_account) "
                . "VALUES('',:fk_receiver_type,:first_name,:last_name,:email,now(),md5(:email),:na_number,:broker_account)");
            $rec->bindParam(':fk_receiver_type',$receiver['type']);
            $rec->bindParam(':first_name',$receiver['first_name']);
            $rec->bindParam(':last_name',$receiver['last_name']);
            $rec->bindParam(':email',$receiver['email']);         
            $rec->bindParam(':na_number',$receiver['na_number']);
            $rec->bindParam(':broker_account',$receiver['broker_acc']);  
            $rec->execute();
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
    public static function updateReceiver($receiver){
        $db= Conn::getConnection();       
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         
        try{
            $res = $db->prepare("UPDATE receivers "
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
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
    public static function unsubscribeReceiver($receiver){
        $db= Conn::getConnection();        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
        try{
            $res = $db->prepare("UPDATE receivers "
                    . "SET active = if(:active=1, 0, 1), "
                    . "date_inactive=if(:active=1, now(), null) "
                    . "WHERE id_receiver=:id");
            $res->bindParam(':id',$receiver['id_receiver'], PDO::PARAM_INT);
            $res->bindParam(':active',$receiver['active'], PDO::PARAM_INT);
            $res->execute();  
            return TRUE;      
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
}
