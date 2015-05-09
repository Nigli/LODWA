<?php
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO;
echo"<pre>";
print_r($_POST);
echo "</pre>";
echo "<br>";
$tr=new TradeRec($_POST);
echo"<pre>";
print_r($tr);
echo "</pre>";
//$sent=TradeRecDAO::InsertTradeRec($tr);
