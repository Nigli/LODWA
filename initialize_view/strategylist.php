<?php
use strategy\StrategyDAO,futures\FuturesContractDAO,utils\Session;

$user = Session::get('user_status');/**GETS USER STATUS**/
$notice_future = Session::get("future");/**GETS NOTICE(creates notice var to use it in notification popup) FROM SESSION WITH INFO OF FUTURE OR STRATEGY SUCCESS**/
$notice_strategy = Session::get("strategy");
Session::unsets('future');
Session::unsets('strategy');

$prog = StrategyDAO::getStrategies();/**GET STRATEGY OBJECTS**/
$future = FuturesContractDAO::getFutures();/**GET FUTURES OBJECTS**/
$user=='3'?include 'admin/strategylist.php':'';/**CHECK IF USER IS ADMIN**/