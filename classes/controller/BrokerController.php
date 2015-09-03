<?php

namespace controller;

use broker\BrokerDAO,
    utils\Validate,
    utils\Session;

class BrokerController extends MainController {

    public $broker;
    public $broker_button;

    public function __construct() {
        parent::__construct();
        $this->broker = BrokerDAO::getBrokerInfo(); /*         * GET BROKER INFO OBJECT* */
        $this->broker_form = 'view/manager/broker.php';
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        
        if ($valid) {/*         * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
            if ($valid['broker-submit'] === "update") {
                $update = BrokerDAO::editBrokerInfo($valid);
                $update ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } elseif ($valid['broker-submit'] === "delete") {
                $delete = BrokerDAO::removeBrokerInfo($valid);
                $delete ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } else {
                $new = BrokerDAO::insertBrokerInfo($valid);
                $new ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            }
        } else {
            Session::set("notify", "notsent");
        }
        redirect_to("broker");
    }

}
