<?php

namespace controller;

use user\UserDAO,
    utils\Pagination;

class SuperadminController extends MainController {

    private $users;
    private $status;
    private $count;
    private $links = array();
    private $pagin;

    public function __construct() {
        parent::__construct();
        $this->links = isset($_GET["page"]) ? $_GET : "";
        $this->count = UserDao::countUsers();
        $this->pagin = new Pagination($this->links, $this->count);
        $this->users = UserDAO::getUsers();
        $this->status = UserDAO::getStatus();
    }

}
