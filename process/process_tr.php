<?php
require '../function_phpmailer.php';
require '../config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email,utils\Session,futures\FuturesContractDAO;

$valid = Validate::tr($_POST);
$tr = new TradeRec($valid);
$email = new Email($tr);
print_r($email->broker_temp);
//phpmailer($email);
//$insert=TradeRecDAO::InsertTradeRec($tr);