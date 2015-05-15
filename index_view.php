<?php
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO,futures\FuturesContractDAO,utils\Session,utils\Render;

$tr_token=md5(uniqid(rand(),true));
Session::set('tr_token', $tr_token);

$lastTR = new TradeRec(TradeRecDAO::GetLastTradeRec());
$futuresContr = FuturesContractDAO::GetFutures();
$last5trs = TradeRecDAO::GetLast5TradeRecs();

echo Render::formRend($futuresContr,$lastTR,$tr_token);
echo Render::trListRend($last5trs);