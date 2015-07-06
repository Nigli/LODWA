<?php

namespace controller;

use utils\Session;

abstract class MainController {
    public $default_receiver_filter=array();
    public $default_trlist_filter=array();
    public $user;
    public $token;
    public $notice;
    public $index_numb;
    public $selected_page;
    public $layout;
    public $layout_admin;
    
    public function __construct(){
        $this->default_receiver_filter = array("p" => "receiverlist", "page" => "1", "active" => "1", "type" => "0", "strategy" => "0", "ba" => "ALL");
        $this->default_trlist_filter = array("p" => "trlist", "page" => "1", "entry_choice" => "0", "fk_future" => "0");
        $this->user = Session::get('user_status');
        $this->token = md5(uniqid(rand(), true));
        $this->notice = null!=(Session::get("notify"))?Session::get("notify"):"";
        $this->index_numb = 0;
        $this->selected_page = $_GET['p'];
        $this->layout = file_get_contents("view/layout.html");
        $this->layout_admin = file_get_contents("view/layout_admin.html");
    }
    public function view(){
        ob_start();
        include "view/{$this->selected_page}.php";
        $content = ob_get_clean();  
        if($this->user == 3){            
            echo str_replace('[CONTENT]', $content, $this->layout_admin);
        }else{      
            echo str_replace('[CONTENT]', $content, $this->layout);            
        }
    }
    public function unsetNotice($contr) {
        return Session::unsets($contr);
    }
    public function setToken() {
        return Session::set('', $this->token);//token za tr i za login
    }
}
