<?php
require '../function_phpmailer.php';
require '../config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email,utils\Session;

$valid = Validate::tr($_POST);
$tr = $valid?new TradeRec($valid):false;
$email = $tr?new Email($tr):false;
$sent = $email?phpmailer($email):false;
echo $email->broker_temp;
//$insert=($sent)?TradeRecDAO::InsertTradeRec($email):false;
$insert?Session::set("tr", "sent"):Session::set("tr", "notsent");
//redirect_to("trade");