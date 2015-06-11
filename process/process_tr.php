<?php
require '../function_phpmailer.php';
require '../config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email;

$valid = Validate::tr($_POST);
$tr = new TradeRec($valid);
$email = new Email($tr);
//phpmailer($email);
//$insert=TradeRecDAO::InsertTradeRec($tr);
redirect_to("trade");