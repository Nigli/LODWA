<?php
require '../config.php';
use strategy\StrategyDAO,utils\Validate;
$valid = Validate::admin($_POST);
if($valid['strategy-submit']==="update"){
    StrategyDAO::UpdateStrategy($valid);
}elseif($valid['strategy-submit']==="delete"){
    StrategyDAO::RemoveStrategy($valid);
}else{
    StrategyDAO::NewStrategy($valid);
}
redirect_to("strategylist");