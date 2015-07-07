<?php
require '../config.php';
use user\UserDAO,user\User,utils\Validate,utils\Session;

$valid = Validate::user($_POST);
$hash = User::createPass($valid['password'], $valid['password_conf']);
if($valid && $hash){
    if($valid['user-submit']==="update"){    
        $valid['hash']= $hash;    
        $user=UserDAO::updateUser($valid);
        $user?Session::set("notify", "sent"):Session::set("notify", "notsent");
    }elseif($valid['user-submit']==="remove"){
        $user=UserDAO::removeUser($valid);
        $user?Session::set("notify", "sent"):Session::set("notify", "notsent");
    }else{      
        $valid['hash']= $hash;
        $user=UserDAO::newUser($valid); 
        $user?Session::set("notify", "sent"):Session::set("notify", "notsent");
    }
}else {
    Session::set("notify", "notsent");
}
redirect_to("admin/1");
