<?php
require '../config.php';
use receiver\ReceiverDao,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
if($valid){
    if($valid['receiver-submit']==="update"){
        $sent = ReceiverDao::UpdateReceiver($valid);
        $sent?Session::set("receiver", "sent"):Session::set("receiver", "notsent");
    }elseif($valid['receiver-submit']==="subscribe"){
        $sent = ReceiverDao::UnsubscribeReceiver($valid);
        $sent?Session::set("receiver", "sent"):Session::set("receiver", "notsent");
        var_dump($valid);
    }else{
        $sent = ReceiverDao::NewReceiver($valid);
        $sent?Session::set("receiver", "sent"):Session::set("receiver", "notsent");
    }
}else {
    Session::set("receiver", "notsent");
}
redirect_to("receiverlist");
