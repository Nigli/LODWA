<?php
namespace broker;
use PDO,utils\Conn;
class BrokerDAO {    
    public static function GetBrokerInfo(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT * FROM broker_info");
            $res->execute();
            $broker_info = $res->fetch(PDO::FETCH_ASSOC);       
            return $broker_info;
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }    
    }
    public static function EditBrokerInfo($broker){
            $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE broker_info "
                . "SET broker_company=:broker_company, "
                    . "broker_name=:broker_name, "
                    . "broker_email=:broker_email "
                . "WHERE id_broker=:id_broker");
            $res->bindParam(':id_broker',$broker['id_broker']);
            $res->bindParam(':broker_company',$broker['company']);
            $res->bindParam(':broker_name',$broker['name']);
            $res->bindParam(':broker_email',$broker['email']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}
