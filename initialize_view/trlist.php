<?php
use traderec\TradeRecDAO,utils\Pagination,futures\FuturesContractDAO;

$default_links = array( "p" => "trlist", "page" => "1", "entry_choice"=>"ALL" ,"fk_future"=>"0");
$links = isset($_GET["page"])?$_GET:$default_links;
$count = TradeRecDAO::CountTrades($links);
$pagin = new Pagination($links,$count);
$lasttrs = TradeRecDAO::GetTradeRecs($pagin,$links);
$listnumb = $pagin->offset;
$futuresContr = FuturesContractDAO::GetFutures();