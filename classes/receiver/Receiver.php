<?php

namespace receiver;

class Receiver {

    public $id_receiver;
    public $fk_receiver_type;
    public $receiver_type_name;
    public $first_name;
    public $last_name;
    public $email;
    public $active;
    public $date_added;
    public $date_inactive;
    public $hash_email;
    public $na_number;
    public $broker_acc;
    public $recipient;
    public $subs_info;

    public function __construct($array =array()) {
        foreach($array as $k=>$v){
            $this->$k = $v;
        }           
        $this->recipient = $this->email . ", " . $this->first_name . " " . $this->last_name;
    }
}
