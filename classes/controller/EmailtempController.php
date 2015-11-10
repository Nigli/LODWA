<?php

namespace controller;

use email\EmailTempDAO,
    utils\Validate,
    utils\Session;

class EmailtempController extends MainController {

    public $emailtemp;

    public function __construct() {
        parent::__construct();
        $this->emailtemp = EmailTempDAO::getEmailTemp();
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid      = Validate::emailTemp($post);
        $emailtemp  = $valid ? EmailTempDAO::updateEmailTemp($valid) : false;
        $emailtemp ? Session::set("notify", "sent") : Session::set("notify", "notsent");
        redirect_to("emailtemp");
    }

}
