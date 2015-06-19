<?php
require '../function_phpmailer.php';
require '../config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email,utils\Session;

$valid = Validate::tr($_POST);
$tr = $valid?new TradeRec($valid):false;
$email = $tr?new Email($tr):false;
//echo $email->broker_temp;
//echo $email->client_temp;
//$sent = $email?phpmailer($email):false;
//$insert=($sent)?TradeRecDAO::InsertTradeRec($tr):false;
$insert = true;
$insert?Session::set("tr", "sent"):Session::set("tr", "notsent");
redirect_to("trade");