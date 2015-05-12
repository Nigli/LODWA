<?php
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO, utils\Validate;
echo"<pre>";
var_dump($_POST);
echo "</pre>";
echo "<br>";
$tr=new TradeRec($_POST);
echo"<pre>";
//print_r($tr);
echo "</pre>";

$valid = Validate::validForm($_POST);

echo"<pre>";
var_dump($valid);
echo "</pre>";
//$inser=TradeRecDAO::InsertTradeRec($valid);
