<?php

namespace broker;

class Broker {

    public $id_broker;
    public $broker_company;
    public $broker_name;
    public $broker_email;

    public function __construct($array = array()) {
        foreach ($array as $k => $v) {
            $this->$k = $v;
        }
    }

}
