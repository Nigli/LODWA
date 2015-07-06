<?php

namespace controller;

use receiver\ReceiverDao;

class UnsubController extends MainController {

    private $subscriber;

    public function __construct() {
        parent::__construct();
        $this->subscriber = isset($_GET['id']) ? ReceiverDao::getReceiverByHash($_GET['id']) : '';
    }

}
