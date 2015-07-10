<?php

namespace controller;

use utils\Session;

class LogoutController extends MainController {

    public function __construct() {
        parent::__construct();
    }

    public function process() {
        Session::destroy();
        redirect_to('./');
    }

}
