<?php
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO,email\Email;
$tr = new TradeRec(TradeRecDAO::GetLastTradeRec());//new trade from form

echo gettype($tr);

echo "<pre>";
print_r($tr);
echo "</pre>";
//print_r($recipients);

$email=new Email($tr);

echo "<pre>";
print_r($email);
echo "</pre>";