<?php
require '../config.php';
use user\UserDAO,user\User,utils\Validate;

$valid = Validate::user($_POST);
$hash = User::createPass($valid['password'], $valid['password_conf']);
if($valid['user-submit']==="update"){    
    $valid['hash']= $hash;    
    UserDAO::UpdateUser($valid);
    var_dump($valid);
}elseif($valid['user-submit']==="remove"){
    UserDAO::RemoveUser($valid);    
    var_dump($valid);
}else{      
    $valid['hash']= $hash;
    UserDAO::NewUser($valid);    
    var_dump($valid);
}
//redirect_to("superadmin/1");
