<?php

namespace controller;

use strategy\StrategyDAO,
    futures\FuturesContractDAO;

class StrategylistController extends MainController {

    public $strategies;
    public $futures;
    public $strategy_form;

    public function __construct() {
        parent::__construct();
        $this->strategies = StrategyDAO::getActiveStrategies(); /*         * GET STRATEGIES ARRAY OF OBJECTS* */
        $this->futures = FuturesContractDAO::getActiveFutures(); /*         * GET FUTURES OBJECTS* */
        $this->strategy_form = "view/manager/strategylist.php";
    }

}
