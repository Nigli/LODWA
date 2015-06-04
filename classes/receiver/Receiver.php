<?php
namespace receiver;
class Receiver {
    public $id_receiver;
    public $fk_receiver_type;
    public $receiver_type;
    public $first_name;
    public $last_name;
    public $email;
    public $active;
    public $date_added;
    public $date_inactive;
    public $na_number;
    public $broker_account;
    public $recipient;
    public $num_subs;
    
    public function __construct(){        
        $this->recipient=$this->email.", ".$this->first_name." ".$this->last_name;
    }   
}