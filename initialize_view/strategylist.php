<?php
use strategy\StrategyDAO,futures\FuturesContractDAO,utils\Session;
$prog = StrategyDAO::GetStrategies();
$future = FuturesContractDAO::GetFutures();
$user = Session::get('user_status');
$user=='3'?include 'admin/strategylist.php':'';