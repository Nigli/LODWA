<?php
require '../config.php';
use strategy\StrategyDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
if($valid){
    if($valid['strategy-submit']==="update"){
        $sent = StrategyDAO::UpdateStrategy($valid);
        $sent?Session::set("strategy", "sent"):Session::set("strategy", "notsent");
    }elseif($valid['strategy-submit']==="delete"){
        $sent = StrategyDAO::RemoveStrategy($valid);
        $sent?Session::set("strategy", "sent"):Session::set("strategy", "notsent");
    }else{
        $sent = StrategyDAO::NewStrategy($valid);
        $sent?Session::set("strategy", "sent"):Session::set("strategy", "notsent");
    }
} else {
    Session::set("future", "notsent");
}
redirect_to("strategylist");