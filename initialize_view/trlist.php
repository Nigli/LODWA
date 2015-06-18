<?php
use traderec\TradeRecDAO,utils\Pagination,futures\FuturesContractDAO;

$links = isset($_GET)?$_GET:"1";
$count = TradeRecDAO::CountTrades($links);
$pagin = new Pagination($links,$count);
$lasttrs = TradeRecDAO::GetTradeRecs($pagin,$links);
$listnumb = $pagin->offset;
$futuresContr = FuturesContractDAO::GetFutures();