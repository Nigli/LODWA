<?php

namespace controller;

use broker\BrokerDAO;

class BrokerController extends mainController {

    public $broker;

    public function __construct() {
        parent::__construct();
        $this->broker = BrokerDAO::getBrokerInfo(); /*         * GET BROKER INFO OBJECT* */
    }

}
