<?php

namespace user;
use utils\Enum;
class User {

    public $user_id;
    public $user_email;
    public $user_pass;
    public $user_status;
    public $status_name;

    public static function createPass($pass, $pass_conf) {
        if ($pass === $pass_conf) {
            $hash = password_hash($pass, PASSWORD_BCRYPT);
            return $hash;
        } else {
            return false;
        }
    }

    public static function pageAccess($user, $page_to_go) {
        $admin_pages = array("admin");
        $manager_pages = array("strategylist", "futureslist", "receiverlist", "emailtemp", "profile", "broker");
        $user_pages = array("trform", "trlist", "strategylist", "futureslist", "receiverlist", "profile", "broker");
        if ($user == Enum::USER) {
            return in_array($page_to_go, $user_pages);
        } elseif ($user ==  Enum::MANAGER) {
            return in_array($page_to_go, $manager_pages);
        } else {
            return in_array($page_to_go, $admin_pages);
        }
    }

}
