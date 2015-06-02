<?php
namespace sender;
use PDO,utils\Conn;
class SenderInfoDAO {
    public static function GetSenderInfo(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT * FROM sender_info");
            $res->execute();
            $sender_info = $res->fetch(PDO::FETCH_ASSOC);       
            return $sender_info;
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }    
    public static function EditSenderInfo($sender){
            $db= Conn::GetConnection();            
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
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}
