<?php

class NaInfo {
    public $na_first_name;
    public $na_last_name;
    public $na_host;
    public $na_email;
    public $na_pass;
    public $na_port;
    public $na_from;
    public function __construct($na_info) {
        foreach($na_info as $k=>$v){
            $this->$k = $v;
            $this->na_from=$this->na_first_name." ".$this->na_last_name;
        }     
    }
}