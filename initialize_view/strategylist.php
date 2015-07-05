<?php

use strategy\StrategyDAO,
    futures\FuturesContractDAO,
    utils\Session;

$user = Session::get('user_status'); /* * GETS USER STATUS* */
$notice_strategy = Session::get("strategy"); /* * GETS NOTICE(creates notice var to use it in notification popup) FROM SESSION WITH INFO OF FUTURE OR STRATEGY SUCCESS* */
Session::unsets('strategy');

$strategies = StrategyDAO::getActiveStrategies(); /* * GET STRATEGY OBJECTS* */
$futures = FuturesContractDAO::getActiveFutures();/* * GET FUTURES OBJECTS* */
$user == '3' ? include 'admin/strategylist.php' : ''; /**CHECK IF USER IS ADMIN**/