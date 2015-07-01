<?php
require '../config.php';
use futures\FuturesContractDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
if($valid){/**CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO**/
    if($valid['futures-submit']==="update"){
        $sent = FuturesContractDAO::updateFutures($valid);
        $sent?Session::set("future", "sent"):Session::set("future", "notsent");
    }elseif($valid['futures-submit']==="delete"){
        $sent = FuturesContractDAO::removeFutures($valid);
        $sent?Session::set("future", "sent"):Session::set("future", "notsent");
    }else{
        $sent = FuturesContractDAO::newFutures($valid);
        $sent?Session::set("future", "sent"):Session::set("future", "notsent");
    }    
} else {
    Session::set("future", "notsent");
}
redirect_to("strategylist");