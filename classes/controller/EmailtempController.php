<?php

namespace controller;

use email\EmailTempDAO;

class EmailtempController extends MainController {

    public $emailtemp;

    public function __construct() {
        parent::__construct();
        $this->emailtemp = EmailTempDAO::getEmailTemp();
    }

}
