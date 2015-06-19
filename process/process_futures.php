<?php
require '../config.php';
use futures\FuturesContractDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
if($valid){
    if($valid['futures-submit']==="update"){
        $sent = FuturesContractDAO::UpdateFutures($valid);
        $sent?Session::set("future", "sent"):Session::set("future", "notsent");
    }elseif($valid['futures-submit']==="delete"){
        $sent = FuturesContractDAO::RemoveFutures($valid);
        $sent?Session::set("future", "sent"):Session::set("future", "notsent");
    }else{
        $sent = FuturesContractDAO::NewFutures($valid);
        $sent?Session::set("future", "sent"):Session::set("future", "notsent");
    }    
} else {
    Session::set("future", "notsent");
}
redirect_to("strategylist");