<?php
namespace user;
use PDO,utils\Conn;
class UserDAO {
    public static function GetUsers(){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("SELECT user_id,user_email, user_pass, user_status, status_name FROM users "
                    . "LEFT JOIN user_status ON user_status=status "
                    . "WHERE active = 1 "
                    . "ORDER BY user_status");
            $res->execute();
            $users = $res->fetchAll(PDO::FETCH_CLASS, "user\User");;
        return $users;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetUserByEmail($user_email){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("SELECT user_id,user_email, user_pass, user_status, status_name FROM users "
                    . "LEFT JOIN user_status ON user_status=status "
                    . "WHERE user_email=:user_email LIMIT 1");
            $res->bindParam(':user_email',$user_email);
            $res->execute();
            $user = $res->fetchObject("user\User");;
        return $user;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    } 
    public static function CountUsers(){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("SELECT COUNT(*) FROM users");
            $res->execute();
            $users = $res->fetchColumn();
        return $users;//!!!have to check if exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }    
    public static function GetStatus(){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("SELECT status,status_name FROM user_status");
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_ASSOC);
        return $receivers;//!!!have to check if exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function NewUser($user){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("INSERT INTO users "
                . "(user_id,user_email,user_pass,user_status) "
                . "VALUES('',:user_email,:user_pass,:user_status)");
            $res->bindParam(':user_email',$user['email']);
            $res->bindParam(':user_pass',$user['hash']);
            $res->bindParam(':user_status',$user['status']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UpdateUser($user){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE users "
                . "SET user_email=:user_email, "
                    . "user_pass=:user_pass, "
                    . "user_status=:user_status "
                . "WHERE user_id=:user_id");
            $res->bindParam(':user_id',$user['id_user']);
            $res->bindParam(':user_email',$user['email']);
            $res->bindParam(':user_pass',$user['hash']);
            $res->bindParam(':user_status',$user['status']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function RemoveUser($user){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE users "
                    . "SET active=0 "
                    . "WHERE user_id=:user_id");
            $res->bindParam(':user_id',$user['id_user']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}
