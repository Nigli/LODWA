<?php
namespace user;
use PDO,utils\Conn;
class UserDAO {
    public static function GetUsers(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM users");
        $res->execute();
        $futures = $res->fetchAll(PDO::FETCH_CLASS, "user\User");;
        return $futures;//!!!have to check if array exists
    }
    public static function GetUserByEmail($user_email){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM users WHERE user_email=:user_email LIMIT 1");
        $res->bindParam(':user_email',$user_email);
        $res->execute();
        $futures = $res->fetchObject("user\User");;
        return $futures;//!!!have to check if array exists
    }
}
