<?php
namespace sender;
use PDO,utils\Conn;
class SenderInfoDAO {
    public static function getSenderInfo(){/**GET ALL SENDER INFO - RETURNS OBJECT**/
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT * FROM sender_info");
            $res->execute();
            $sender_info = $res->fetchObject("sender\SenderInfo");       
            return $sender_info;
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }    
    public static function editSenderInfo($sender){
        $db= Conn::getConnection();     
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
        try{
            $res = $db->prepare("UPDATE sender_info "
                . "SET company_name=:company_name, "
                    . "company_website=:company_website, "
                    . "sender_name=:sender_name, "
                    . "sender_email=:sender_email, "
                    . "sender_address=:sender_address "
                . "WHERE id_sender=:id_sender");
            $res->bindParam(':id_sender',$sender['id_sender']);
            $res->bindParam(':company_name',$sender['company']);
            $res->bindParam(':company_website',$sender['website']);
            $res->bindParam(':sender_name',$sender['name']);
            $res->bindParam(':sender_email',$sender['email']);
            $res->bindParam(':sender_address',$sender['address']);
            $res->execute();
            return TRUE;
        }catch(\PDOException $e){
            return FALSE;
            //echo "error". $e->getMessage();
        }
    }
}
