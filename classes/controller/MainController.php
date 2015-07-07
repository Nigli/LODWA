<?php

namespace controller;

use utils\Session,
    utils\Enum,
    user\User;

abstract class MainController {

    public $default_receiver_filter = array();
    public $default_trlist_filter = array();
    public $user_id;
    public $user_status;
    public $token;
    public $notice;
    public $index_numb;
    public $selected_page;
    public $access;
    public $layout;
    public $layout_admin;

    public function __construct() {
        //filters...
        $this->default_receiver_filter = array("p" => "receiverlist", "page" => "1", "active" => "1", "type" => "0", "strategy" => "0", "ba" => "ALL");
        $this->default_trlist_filter = array("p" => "trlist", "page" => "1", "entry_choice" => "0", "fk_future" => "0");

        //sessions...
        $this->user_id = Session::get('user_id');
        $this->user_status = Session::get('user_status');
        $this->notice = null != (Session::get("notify")) ? Session::get("notify") : "";

        //variables...
        $this->token = md5(uniqid(rand(), true));
        $this->index_numb = 0;
        $this->selected_page = isset($_GET['p']) ? $_GET['p'] : "";
        $this->access = User::pageAccess($this->user_status, $this->selected_page);

        //layouts...
        $this->layout = file_get_contents("view/layouts/layout.html");
        $this->layout_manager = file_get_contents("view/layouts/layout_manager.html");
        $this->layout_admin = file_get_contents("view/layouts/layout_admin.html");
    }

    public function view() {
        ob_start();
        if (!($this->selected_page)) {
            include $this->layout_login;
            $view = ob_get_clean();
        } elseif ($this->access) {
            
            if ($this->user_status == Enum::MANAGER) {
                
                include "view/{$this->selected_page}.php";
                $content = ob_get_clean();
                $view = str_replace('[CONTENT]', $content, $this->layout_manager);
            } elseif ($this->user_status == Enum::USER) {

                include "view/{$this->selected_page}.php";
                $content = ob_get_clean();
                $view = str_replace('[CONTENT]', $content, $this->layout);
            } else {

                include $this->admin_page;
                $content = ob_get_clean();
                $view = str_replace('[CONTENT]', $content, $this->layout_admin);
            }
        } else {
            redirect_to("logout");
        }
        echo $view;
    }

    public function unsetNotice($contr) {
        return Session::unsets($contr);
    }

    public function setToken($token_name) {
        return Session::set($token_name, $this->token); //token za tr i za login
    }

}
