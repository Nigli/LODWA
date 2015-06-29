<?php
require '../config.php';
use user\UserDAO,user\User,utils\Validate,utils\Session;

$valid = Validate::user($_POST);
$hash = User::createPass($valid['password'], $valid['password_conf']);
if($valid && $hash){
    if($valid['user-submit']==="update"){    
        $valid['hash']= $hash;    
        $user=UserDAO::UpdateUser($valid);
        $user?Session::set("admin", "sent"):Session::set("admin", "notsent");
    }elseif($valid['user-submit']==="remove"){
        $user=UserDAO::RemoveUser($valid);
        $user?Session::set("admin", "sent"):Session::set("admin", "notsent");
    }else{      
        $valid['hash']= $hash;
        $user=UserDAO::NewUser($valid); 
        $user?Session::set("admin", "sent"):Session::set("admin", "notsent");
    }
}else {
    Session::set("admin", "notsent");
}
redirect_to("superadmin/1");
