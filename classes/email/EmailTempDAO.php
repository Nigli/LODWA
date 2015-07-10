<?php
namespace email;
use PDO,utils\Conn;
class EmailTempDAO {
    public static function getEmailTemp(){/**GET EMAIL TEMPLATE DISCLOSURE - RETURN OBJECT**/
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("SELECT id_email,disclosure "
                . "FROM email_temp "
                . "WHERE id_email=1");
            $res->execute();
            $email_temp = $res->fetchObject(get_class());
            return $email_temp;//!!!have to check if exists        
        }catch(\PDOException $e){
            Conn::logConnectionErr($e->getMessage());
            return FALSE;
        }
    }
    public static function updateEmailTemp($email){
        $db= Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        try{
            $res = $db->prepare("UPDATE email_temp "
                . "SET disclosure=:disclosure "
                . "WHERE id_email=1");        
            $res->bindParam(':disclosure',$email['disclosure']);
            $res->execute();
            return TRUE;
        }catch(\PDOException $e){
            Conn::logConnectionErr($e->getMessage());
            return FALSE;
        }
    }
}
