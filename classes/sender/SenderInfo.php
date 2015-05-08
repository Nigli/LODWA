<?php
namespace sender;
class SenderInfo {
    public $id_sender;
    public $sender_first_name;
    public $sender_last_name;
    public $sender_host;
    public $sender_email;
    public $sender_pass;
    public $sender_port;
    public $sender_from;
    public function __construct($sender_info) {
        foreach($sender_info as $k=>$v){
            $this->$k = $v;
            $this->sender_from=$this->sender_first_name." ".$this->sender_last_name;
        }     
    }
}