<?php
require 'config.php';

$tr = new \traderec\TradeRec(\traderec\TradeRecDAO::GetLastTradeRec());//new trade from form

echo gettype($tr);

echo "<pre>";
print_r($tr);
echo "</pre>";
//print_r($recipients);

$email=new \email\Email($tr);

echo "<pre>";
print_r($email);
echo "</pre>";