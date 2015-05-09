<?php
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO;
//$fk_future=1;
//$fk_tr_strategy=1;
//$month="August";
//$year="2015";
//$num_contr=2;
//$entry_choice="BUY";
//$entry_price=1021.10;
//$price_target=1021.10;
//$stop_loss=1021.10;

//print_r(TradeRecDAO::GetTradeRec());
//$test = TradeRecDAO::GetTradeRec();
//echo "<br>";
//echo $test[0]->date;

print_r(TradeRecDAO::GetLastTradeRec());
$test = TradeRecDAO::GetLastTradeRec();
echo "<br>";
//echo $test->date;

$test2 = new TradeRec($test);
print_r($test2);

//\traderec\TradeRecDAO::NewTradeRec($fk_future,$fk_tr_strategy,$month,$year,$num_contr,$entry_choice,$entry_price,$price_target,$stop_loss);