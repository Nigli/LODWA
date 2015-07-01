<?php
use traderec\TradeRecDAO,futures\FuturesContractDAO,utils\Session;

$tr_token=md5(uniqid(rand(),true));/**CREATES TOKEN AND PUTS IT IN A SESSION**/
Session::set('tr_token', $tr_token);
$notice = Session::get('tr');/**GETS NOTICE(creates notice var to use it in notification popup) FROM SESSION WITH INFO OF TR SUCCESS**/
Session::unsets('tr');

$futuresContr = FuturesContractDAO::getFutures();/**GETS ARRAY OF FUTURES OBJECTS**/
if($futuresContr){
    foreach ($futuresContr as $key => $future) {
        Session::set("cont".$future->id_futures,$future->strategy_name);
    }
}else{
    //Session::set("err", "trerror");
}
$last5trs = TradeRecDAO::getLast5TradeRecs();/**GETS ARRAY OF 5 TR OBJECTS**/
$lastTR = $last5trs[0];/**GETS LAST TR OBJECT**/
$listnumb = 0;/**MARK NUMBER OF TR**/