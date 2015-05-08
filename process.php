<?php
require 'config.php';


print_r($_POST);
echo "<br>";
$tr=new \traderec\TradeRec($_POST);
print_r($tr);
echo "<br>";
//TradeRecDAO::InsertTradeRec($tr);