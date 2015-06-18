<?php
require '../config.php';
use futures\FuturesContractDAO,utils\Validate;

$valid = Validate::admin($_POST);
var_dump($_POST);
var_dump($valid);
if($valid['futures-submit']==="update"){
    FuturesContractDAO::UpdateFutures($valid);    
}elseif($valid['futures-submit']==="delete"){
    FuturesContractDAO::RemoveFutures($valid);
}else{
    FuturesContractDAO::NewFutures($valid);
}
//redirect_to("strategylist");