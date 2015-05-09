<?php
namespace utils;
use PDO;
class Conn{
    const DBUSER = "root";
    const DBPASS = "";
    const DBHOST = "localhost";
    const DB = "lodwp";
   
    public static $conn;
    public static function GetConnection(){
        if(!self::$conn){
            try{
                self::$conn=new PDO("mysql:dbhost=".self::DBHOST.";dbname=".self::DB.";charset=utf8",self::DBUSER,self::DBPASS);         
            }
            catch (PDOException $e){
                echo 'Connection failed: ' . $e->getMessage();
            }
       }
       return self::$conn;
    }
}