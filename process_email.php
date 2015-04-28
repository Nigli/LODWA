<?php
require 'config.php';



$tr = new TradeRec(TradeRecDAO::GetLastTradeRec());//new trade from form

$clients=ReceiverDao::GetClientsReceivers();
$email_temp=EmailTemp::GetEmailTemp();



echo "<pre>";
print_r($clients);
echo "</pre>";
//print_r($recipients);

$email=new Email($clients,$tr,$email_temp);
print_r($email);