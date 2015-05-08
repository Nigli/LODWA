<?php
namespace broker;
class Broker {
    public $id_broker;
    public $broker_first_name;
    public $broker_last_name;
    public $broker_email;
    public $broker_to;
    public function __construct($broker_info) {
        foreach($broker_info as $k=>$v){
            $this->$k = $v;
            $this->broker_to=$this->broker_first_name." ".$this->broker_last_name;
        }     
    }
}
