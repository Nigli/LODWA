<?php
namespace broker;
use PDO,utils\Conn;
class BrokerDAO {    
    public static function getBrokerInfo(){/**GET ALL BROKER INFO - RETURNS OBJECT**/       
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT * FROM broker_info "
                    . "WHERE status = 1");
            $res->execute();
            $broker_info = $res->fetchAll(PDO::FETCH_CLASS, "broker\Broker");       
            return $broker_info;
        }catch(\PDOException $e){
            Conn::logConnectionErr($e->getMessage());
            return FALSE;
        }    
    }
    public static function editBrokerInfo($broker){
        $db= Conn::getConnection();            
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("UPDATE broker_info "
                . "SET broker_company=:broker_company, "
                    . "broker_name=:broker_name, "
                    . "broker_email=:broker_email "
                . "WHERE id_broker=:id_broker");
            $res->bindParam(':id_broker',$broker['id_broker']);
            $res->bindParam(':broker_company',$broker['broker_company']);
            $res->bindParam(':broker_name',$broker['broker_name']);
            $res->bindParam(':broker_email',$broker['broker_email']);
            $res->execute();
            return TRUE;
        }catch(\PDOException $e){
            Conn::logConnectionErr($e->getMessage());
            return FALSE;
        }
    }
    
    public static function removeBrokerInfo($broker){
        $db= Conn::getConnection();            
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("UPDATE broker_info "
                . "SET status = 0 "
                . "WHERE id_broker=:id_broker");
            $res->bindParam(':id_broker',$broker['id_broker']);
            $res->execute();
            return TRUE;
        }catch(\PDOException $e){
            Conn::logConnectionErr($e->getMessage());
            return FALSE;
        }
    }
    
    public static function insertBrokerInfo($broker) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO broker_info "
                    . "(id_broker, broker_company, broker_name, broker_email) "
                    . "VALUES('', :broker_company, :broker_name, :broker_email)");
            $res->bindParam(':broker_company', $broker['broker_company']);
            $res->bindParam(':broker_name', $broker['broker_name']);
            $res->bindParam(':broker_email', $broker['broker_email']);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
}
