<?php

namespace controller;

class LoginController extends MainController {

    public $layout_login;

    public function __construct() {
        parent::__construct();
        $this->setToken("login_token");
        $this->layout_login = "view/login.php";
    }

}
