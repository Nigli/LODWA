<?php

namespace controller;

use broker\BrokerDAO;

class BrokerController extends mainController {

    public $broker;
    public $broker_button;

    public function __construct() {
        parent::__construct();
        $this->broker = BrokerDAO::getBrokerInfo(); /*         * GET BROKER INFO OBJECT* */
        $this->broker_button = 'view/manager/broker.html';
    }

}
