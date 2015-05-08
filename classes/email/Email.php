<?php
namespace email;
class Email{
    public $id_sender;
    public $sender_first_name;
    public $sender_last_name;
    public $sender_host;
    public $sender_email;
    public $sender_pass;
    public $sender_port;
    public $sender_from;
    
    public $id_broker;
    public $broker_first_name;
    public $broker_last_name;
    public $broker_email;
    public $broker_to;
    
    public $recipients=array();
    public $title;
    public $num_subs;
    
    public $disclosure;
    
    public $broker_temp;
    public $client_temp;
    
    public function __construct($tr) {
        $sender_info=new \sender\SenderInfo(\sender\SenderInfoDAO::GetSenderInfo());
        foreach($sender_info as $k=>$v){
            $this->$k = $v;
        }
        $broker_info = new \broker\Broker(\broker\BrokerDAO::GetBrokerInfo());
        foreach($broker_info as $k=>$v){
            $this->$k = $v;
        }
        foreach (\receiver\ReceiverDao::GetClientsReceivers() as $k=>$v){
            $this->recipients[]=$v->recipient;
        }
        $this->num_subs=\receiver\ReceiverDao::GetClientsSubs($tr->fk_future, $tr->num_contr);
        $this->title=$tr->title;
        
        $this->disclosure=\email\EmailTemp::GetEmailTemp()->disclosure;
        
        ob_start();
        include 'emailtemplates/broker_temp.php';
        $this->broker_temp= ob_get_clean();
        ob_start();
        include 'emailtemplates/client_temp.php';
        $this->client_temp= ob_get_clean();
    }
}