<?php

class Email {
    public $recipients=array();
    public $title;
    public $body;
    public $disclosure;
    
    public function __construct($receiver,$tr,$email_temp) {
        foreach ($receiver as $k=>$v){
            $this->recipients[]=$v->recipient;
        }
        $this->title=$tr->title;
        ///BODY!!!!
        $this->disclosure=$email_temp->disclosure;
    }
}
