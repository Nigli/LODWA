<?php
require '../config.php';
use futures\FuturesContractDAO,utils\Validate;
$valid = Validate::admin($_POST);
if($valid['futures-submit']==="update"){
    FuturesContractDAO::UpdateFutures($valid);
}elseif($valid['futures-submit']==="delete"){
    FuturesContractDAO::RemoveFutures($valid);
}else{
    FuturesContractDAO::NewFutures($valid);
}
