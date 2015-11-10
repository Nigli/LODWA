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

    public static function pageAccess($user, $page_to_go) {/* CONTAINS ARRAYS OF PAGES THAT EACH USER CAN ACCESS */
        $admin_pages        = array("admin");
        $manager_lev1_pages = array("strategylist", "trlist", "futureslist", "receiverlist", "emailtemp", "profile", "broker");
        $manager_lev2_pages = array("receiverlist", "trlist", "emailtemp", "profile", "broker");
        $user_pages = array("trform", "trlist", "strategylist", "futureslist", "receiverlist", "profile", "broker");
        
        if ($user == Enum::USER) {
            return in_array($page_to_go, $user_pages);
        } elseif ($user == Enum::MANAGER_LEV1) {
            return in_array($page_to_go, $manager_lev1_pages);
        } elseif ($user == Enum::MANAGER_LEV2) {
            return in_array($page_to_go, $manager_lev2_pages);
        } else {
            return in_array($page_to_go, $admin_pages);
        }
    }

}
