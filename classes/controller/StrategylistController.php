<?php

namespace controller;

use strategy\StrategyDAO,
    futures\FuturesContractDAO;

class StrategylistController extends MainController {

    public $strategies;
    public $futures;

    public function __construct() {
        parent::__construct();
        $this->strategies = StrategyDAO::getActiveStrategies(); /*         * GET STRATEGIES ARRAY OF OBJECTS* */
        $this->futures = FuturesContractDAO::getActiveFutures(); /*         * GET FUTURES OBJECTS* */
    }

}
