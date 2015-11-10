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

    public function __construct($array = array()) {
        foreach ($array as $k => $v) {
            $this->$k = $v;
        }
        $this->recipient = array(/* THIS ARRAY IS USED FOR EMAIL CONSTRUCTOR TO PUT HASH EMAIL ON THE BOTTOM OF THE EMAIL */
            "id_receiver"   => $this->id_receiver,
            "email"         => $this->email,
            "first_name"    => $this->first_name,
            "last_name"     => $this->last_name,
            "hash_email"    => $this->hash_email
        );
    }

}
