<?php

namespace controller;

use futures\FuturesContractDAO;

class FutureslistController extends MainController {

    public $future;
    public $futures_form;

    public function __construct() {
        parent::__construct();
        $this->future = FuturesContractDAO::getActiveFutures(); /*         * GET FUTURES INFO OBJECT* */ 
        $this->futures_form = "view/manager/futureslist.php";
    }

}
