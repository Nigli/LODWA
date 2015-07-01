<?php
require '../config.php';
use strategy\StrategyDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
if($valid){/**CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO**/
    if($valid['strategy-submit']==="update"){
        $sent = StrategyDAO::updateStrategy($valid);
        $sent?Session::set("strategy", "sent"):Session::set("strategy", "notsent");
    }elseif($valid['strategy-submit']==="delete"){
        $sent = StrategyDAO::removeStrategy($valid);
        $sent?Session::set("strategy", "sent"):Session::set("strategy", "notsent");
    }else{
        $sent = StrategyDAO::newStrategy($valid);
        $sent?Session::set("strategy", "sent"):Session::set("strategy", "notsent");
    }
} else {
    Session::set("future", "notsent");
}
redirect_to("strategylist");