<?php

namespace controller;

use sender\SenderInfoDAO,
    utils\Validate,
    utils\Session;

class ProfileController extends MainController {

    public $sender;
    public $profile_buttons;

    public function __construct() {
        parent::__construct();
        $this->sender = SenderInfoDAO::getSenderInfo(); /*         * GET FUTURES INFO OBJECT* */
        $this->profile_buttons = "view/manager/profile.html";
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        $sender = $valid ? SenderInfoDAO::editSenderInfo($valid) : false;
        $sender ? Session::set("notify", "sent") : Session::set("notify", "notsent");
        redirect_to("profile");
    }

}
