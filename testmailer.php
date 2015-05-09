<?php
require 'config.php';
require 'function_phpmailer.php';
use traderec\TradeRec,traderec\TradeRecDAO,email\Email;

$tr=new TradeRec(TradeRecDAO::GetLastTradeRec());//comes from form
$email=new Email($tr);

echo"<pre>";
print_r($email);
echo "</pre>";
//phpmailer($email);