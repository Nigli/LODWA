<?php
use traderec\TradeRecDAO,utils\Pagination,futures\FuturesContractDAO;

$default_links = array( "p" => "trlist", "page" => "1", "entry_choice"=>"ALL" ,"fk_future"=>"0");/**DEFAULT GET PARAMETERS FOR FILTERS**/
$links = isset($_GET["page"])?$_GET:$default_links;/**IF PAGE IS NOT SET USE DEFAULT**/
$count = $links?TradeRecDAO::countTrades($links):FALSE;
$pagin = $count?new Pagination($links,$count):FALSE;
$lasttrs = $links&&$pagin?TradeRecDAO::getTradeRecs($pagin,$links):FALSE;
$listnumb = $pagin?$pagin->offset:FALSE; 
$futuresContr = FuturesContractDAO::getFutures();