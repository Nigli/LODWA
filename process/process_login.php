<?php
require '../config.php';
use utils\Validate,user\UserDAO,utils\Session;

$valid = Validate::login($_POST);
$user = UserDAO::GetUserByEmail($valid['email']);
var_dump($user);
if(Validate::checkPassHash($valid['pass'], $user->user_pass)){
    Session::set("user_id", $user->user_id);
    Session::set("user_status", $user->user_status);
    if($user->user_status==1){
        redirect_to("trade");
    }else {
        redirect_to("strategylist");
    }
}else {
    //redirect_to("login");
    Session::set("err", "loginerror");
}