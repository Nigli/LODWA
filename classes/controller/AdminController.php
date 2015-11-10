<?php

namespace controller;

use user\UserDAO,
    user\User,
    utils\Pagination,
    utils\Validate,
    utils\Session;

class AdminController extends MainController {

    public $users;
    public $status;
    public $count;
    public $links = array();
    public $pagin;
    public $admin_page;

    public function __construct() {
        parent::__construct();
        $this->links        = isset($_GET["page"]) ? $_GET : "";
        $this->count        = UserDAO::countUsers();
        $this->pagin        = new Pagination($this->links, $this->count);
        $this->users        = UserDAO::getUsers();
        $this->status       = UserDAO::getStatus();
        $this->admin_page   = "view/admin.php";
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::user($post);
        $hash = User::createPass($valid['password'], $valid['password_conf']);
        if ($valid && $hash) {
            if ($valid['user-submit'] === "update") {
                $valid['hash']  = $hash;
                $user           = UserDAO::updateUser($valid);
                $user ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } elseif ($valid['user-submit'] === "remove") {
                $user           = UserDAO::removeUser($valid);
                $user ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } else {
                $valid['hash'] = $hash;
                $user           = UserDAO::newUser($valid);
                $user ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            }
        } else {
            Session::set("notify", "notsent");
        }
        redirect_to("admin/1");
    }

}
