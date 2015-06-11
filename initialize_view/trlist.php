<?php
use traderec\TradeRecDAO,utils\Pagination;

$count = TradeRecDAO::CountTrades();
$links = isset($_GET)?$_GET:"1";
$pagin = new Pagination($links,$count);
$lasttrs = TradeRecDAO::GetTradeRecs($pagin);
$listnumb = $pagin->offset;