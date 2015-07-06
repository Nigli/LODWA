<?php

namespace controller;

use traderec\TradeRecDAO,
    futures\FuturesContractDAO;

class TrformController extends MainController {

    public $futures;
    public $last5TR;
    public $lastTR;

    public function __construct() {
        parent::__construct();
        $this->futures = FuturesContractDAO::getActiveFutures(); /*         * GETS ARRAY OF FUTURES OBJECTS* */
        $this->last5TR = TradeRecDAO::getLast5TradeRecs(); /*         * GETS ARRAY OF 5 TR OBJECTS* */
        $this->lastTR = $this->last5TR[0];
    }

}
