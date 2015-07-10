<?php

namespace controller;

use broker\BrokerDAO,
    utils\Validate,
    utils\Session;

class BrokerController extends mainController {

    public $broker;
    public $broker_button;

    public function __construct() {
        parent::__construct();
        $this->broker = BrokerDAO::getBrokerInfo(); /*         * GET BROKER INFO OBJECT* */
        $this->broker_button = 'view/manager/broker.html';
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        $broker = $valid ? BrokerDAO::editBrokerInfo($valid) : FALSE;
        $broker ? Session::set("notify", "sent") : Session::set("notify", "notsent");
        redirect_to("broker");
    }

}
