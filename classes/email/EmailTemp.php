<?php
namespace email;
use PDO;
class EmailTemp {
    public static function GetEmailTemp(){
        $db= \dbase\Conn::GetConnection();
        $res = $db->prepare("SELECT id_email,disclosure FROM email_temp WHERE id_email=1");
        $res->execute();
        $email_temp = $res->fetchObject(get_class());
        return $email_temp;//!!!have to check if exists
    }
}
