<?php

class Email {
    public $na_first_name;
    public $na_last_name;
    public $na_host;
    public $na_email;
    public $na_pass;
    public $na_port;
    public $na_from;
    
    
    public $recipients=array();
    public $title;
    public $num_subs;
    
    public $disclosure;
    
    
    
    public function __construct($tr) {
        $na_info=new NaInfo(NaInfoDAO::GetNaInfo());
        foreach($na_info as $k=>$v){
            $this->$k = $v;
            $this->na_from=$this->na_first_name." ".$this->na_last_name;
        }        
        foreach (ReceiverDao::GetClientsReceivers() as $k=>$v){
            $this->recipients[]=$v->recipient;
        }
        $this->num_subs=ReceiverDao::GetClientsSubs($tr->fk_future, $tr->num_contr);
        $this->title=$tr->title;
        $this->disclosure=EmailTemp::GetEmailTemp()->disclosure;
    }
}
