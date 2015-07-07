<?php

namespace controller;

use user\UserDAO,
    utils\Pagination;

class AdminController extends MainController {

    public $users;
    public $status;
    public $count;
    public $links = array();
    public $pagin;
    public $admin_page;

    public function __construct() {
        parent::__construct();
        $this->links = isset($_GET["page"]) ? $_GET : "";
        $this->count = UserDao::countUsers();
        $this->pagin = new Pagination($this->links, $this->count);
        $this->users = UserDAO::getUsers();
        $this->status = UserDAO::getStatus();
        $this->admin_page = "view/admin.php";
    }

}
