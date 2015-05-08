<?php 

require 'config.php';
require 'function_phpmailer.php';
$tr=new \traderec\TradeRec(\traderec\TradeRecDAO::GetLastTradeRec());//comes from form
$email=new \email\Email($tr);

//print_r($email);

//phpmailer($email);