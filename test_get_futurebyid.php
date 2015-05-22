<?php
require 'config.php';
use futures\FuturesContractDAO;

$future = FuturesContractDAO::GetFuturesById(1);
var_dump($future);

