<?php
require '../config.php';
use utils\Validate,user\UserDAO,utils\Session;

$valid = Validate::login($_POST);
$user = $valid?Validate::checkUser($valid):false;
if($user){
    Session::set("user_id", $user->user_id);
    Session::set("user_status", $user->user_status);
    if($user->user_status==8){
        redirect_to("superadmin/1");  
    }elseif($user->user_status==3) {
        redirect_to("strategylist");
    }else {      
        redirect_to("trade");
    }
}else {
    Session::set("err", "loginerror");
    redirect_to("login");
}