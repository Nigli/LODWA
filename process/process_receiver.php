<?php
require '../config.php';
use receiver\ReceiverDao,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
if($valid){/**CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO**/
    if($valid['receiver-submit']==="update"){
        $sent = ReceiverDao::updateReceiver($valid);
        $sent?Session::set("receiver", "sent"):Session::set("receiver", "notsent");
    }elseif($valid['receiver-submit']==="subscribe"){
        $sent = ReceiverDao::unsubscribeReceiver($valid);
        $sent?Session::set("receiver", "sent"):Session::set("receiver", "notsent");
    }else{
        $sent = ReceiverDao::newReceiver($valid);
        $sent?Session::set("receiver", "sent"):Session::set("receiver", "notsent");
    }
}else {
    Session::set("receiver", "notsent");
}
redirect_to("receiverlist");
