<?php
require 'config.php';
use traderec\TradeRecDAO;
$tr = TradeRecDAO::GetTradeRecs();
var_dump($tr);
