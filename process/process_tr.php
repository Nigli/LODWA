<?php
require '../function_phpmailer.php';
require '../config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email,utils\Session,futures\FuturesContractDAO;
//var_dump($_POST);

$valid = Validate::tr($_POST);
//echo"Valid";
//var_dump($valid);
//echo $_SERVER['HTTP_REFERER'];
//var_dump(Session::get('tr_token'));
$tr = new TradeRec($valid);
//echo"TR";
//var_dump($tr);
$email = new Email($tr);
print_r($email->broker_temp);
//phpmailer($email);
//$insert=TradeRecDAO::InsertTradeRec($tr);