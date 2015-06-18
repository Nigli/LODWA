<?php
require '../function_phpmailer.php';
require '../config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email;

$valid = Validate::tr($_POST);
$tr = new TradeRec($valid);
$email = new Email($tr);
echo $email->broker_temp;
echo $email->client_temp;
//phpmailer($email);
$insert=TradeRecDAO::InsertTradeRec($tr);
//sleep(5);
//redirect_to("trade");