<?php
require '../function_phpmailer.php';
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO,utils\Validate,email\Email;
//echo"<pre>";
//var_dump($_POST);
//echo "</pre>";
//echo "<br>";
//$tr=new TradeRec($_POST);
//echo"<pre>";
//print_r($tr);
//echo "</pre>";

$valid = Validate::tr($_POST);
//echo"<pre>";
//var_dump($valid);
//echo "</pre>";
//echo Session::get("tr_token")."<br>";
//echo $_POST['tr_token'];
//echo $_SERVER['HTTP_REFERER'];
$tr = new TradeRec($valid);
$email = new Email($tr);
phpmailer($email);
//$insert=TradeRecDAO::InsertTradeRec($tr);
