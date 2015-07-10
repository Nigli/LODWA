<?php

namespace sender;

class SenderInfo {

    public $id_sender;
    public $company_name;
    public $company_website;
    public $sender_name;
    public $sender_host;
    public $sender_email;
    public $sender_pass;
    public $sender_port;
    public $sender_address;

    public function __construct($array = array()) {
        foreach ($array as $k => $v) {
            $this->$k = $v;
        }
    }

}
