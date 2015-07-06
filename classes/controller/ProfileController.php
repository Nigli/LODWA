<?php

namespace controller;

use sender\SenderInfoDAO;

class ProfileController extends MainController {

    public $sender;

    public function __construct() {
        parent::__construct();
        $this->sender = SenderInfoDAO::getSenderInfo(); /*         * GET FUTURES INFO OBJECT* */
    }

}
