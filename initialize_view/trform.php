<?php
use traderec\TradeRecDAO,futures\FuturesContractDAO,utils\Session;
$tr_token=md5(uniqid(rand(),true));
Session::set('tr_token', $tr_token);
$notice = Session::get('tr');
Session::unsets('tr');
$futuresContr = FuturesContractDAO::GetFutures();
foreach ($futuresContr as $key => $future) {
    Session::set("cont".$future->id_futures,$future->strategy_name);
}
$last5trs = TradeRecDAO::GetLast5TradeRecs();
$lastTR = $last5trs[0];
$listnumb = 0;