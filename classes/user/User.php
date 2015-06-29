<?php
namespace user;
class User {
    public $user_id;
    public $user_email;
    public $user_pass;
    public $user_status;
    public $status_name;
    
    public static function createPass($pass, $pass_conf) {
        if($pass === $pass_conf){
            $hash = password_hash($pass, PASSWORD_BCRYPT);
            return $hash;
        }
        else {
            return false;
        }
    }
    public static function  pageAccess($use, $get){
        $superadmin = array("superadmin");
        $admin = array ("strategylist","receiverlist","emailtemp","profile","broker");
        $user =  array ("trade","trlist","strategylist","receiverlist","profile","broker");
        if($use==1){
            return in_array($get, $user);
        }elseif($use==3){
            return in_array($get, $admin);
        }else {
            return in_array($get, $superadmin);
        }
    }
}