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
    public static function  pageAccess($use, $page_to_go){
        $superadmin_pages = array("superadmin");
        $admin_pages = array ("strategylist","futureslist","receiverlist","emailtemp","profile","broker");
        $user_pages =  array ("trade","trlist","strategylist","futureslist","receiverlist","profile","broker");
        if($use==1){
            return in_array($page_to_go, $user_pages);
        }elseif($use==3){
            return in_array($page_to_go, $admin_pages);
        }else {
            return in_array($page_to_go, $superadmin_pages);
        }
    }
}