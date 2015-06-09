<?php
require '../config.php';
use receiver\ReceiverDao,utils\Validate;
$valid = Validate::admin($_POST);

if($valid['receiver-submit']==="update"){
    ReceiverDao::UpdateReceiver($valid);
}elseif($valid['receiver-submit']==="unsubscribe"){
    ReceiverDao::UnsubscribeReceiver($valid);
}else{
    ReceiverDao::NewReceiver($valid);
}
