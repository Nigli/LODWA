<?php
use strategy\StrategyDAO,futures\FuturesContractDAO,utils\Session;

$user = Session::get('user_status');
$notice_future = Session::get("future");
$notice_strategy = Session::get("strategy");
Session::unsets('future');
Session::unsets('strategy');

$prog = StrategyDAO::GetStrategies();
$future = FuturesContractDAO::GetFutures();
$user=='3'?include 'admin/strategylist.php':'';