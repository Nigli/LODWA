<?php

namespace controller;

use futures\FuturesContractDAO;

class FutureslistController extends MainController {

    public $future;

    public function __construct() {
        parent::__construct();
        $this->future = FuturesContractDAO::getActiveFutures(); /*         * GET FUTURES INFO OBJECT* */     
    }

}
