<?php
namespace broker;
class Broker {
    public $id_broker;
    public $broker_company;
    public $broker_name;
    public $broker_email;
    public function __construct($broker_info) {
        foreach($broker_info as $k=>$v){
            $this->$k = $v;
        }     
    }
}
