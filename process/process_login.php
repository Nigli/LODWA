<?php
require '../config.php';
use utils\Validate,user\UserDAO,utils\Session;

$valid = Validate::login($_POST);
$user = UserDAO::GetUserByEmail($valid['email']);
var_dump($user);
if(Validate::checkPassHash($valid['pass'], $user->user_pass)){
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
}