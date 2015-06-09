<?php
namespace email;
use PDO,utils\Conn;
class EmailTempDAO {
    public static function GetEmailTemp(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_email,disclosure "
                . "FROM email_temp "
                . "WHERE id_email=1");
            $res->execute();
            $email_temp = $res->fetchObject(get_class());
            return $email_temp;//!!!have to check if exists        
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UpdateEmailTemp($email){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("UPDATE email_temp "
                . "SET disclosure=:disclosure "
                . "WHERE id_email=1");        
            $res->bindParam(':disclosure',$email['disclosure']);
            $res->execute();        
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}
