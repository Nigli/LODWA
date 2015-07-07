<?php

namespace controller;

use sender\SenderInfoDAO;

class ProfileController extends MainController {

    public $sender;
    public $profile_buttons;

    public function __construct() {
        parent::__construct();
        $this->sender = SenderInfoDAO::getSenderInfo(); /*         * GET FUTURES INFO OBJECT* */
        $this->profile_buttons = "view/manager/profile.html";
    }

}
