<?php
namespace email;
use sender\SenderInfo,sender\SenderInfoDAO,broker\Broker,broker\BrokerDAO,receiver\Receiver,receiver\ReceiverDao,email\EmailTemp;

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
        $sender_info=new SenderInfo(SenderInfoDAO::GetSenderInfo());
        foreach($sender_info as $k=>$v){
            $this->$k = $v;
        }
        $broker_info = new Broker(BrokerDAO::GetBrokerInfo());
        foreach($broker_info as $k=>$v){
            $this->$k = $v;
        }
        foreach (ReceiverDao::GetClientsReceivers() as $k=>$v){
            $this->recipients[]=$v->recipient;
        }
        $this->num_subs=ReceiverDao::GetClientsSubs($tr->fk_future, $tr->num_contr);
        $this->title=$tr->title;
        
        $this->disclosure=EmailTemp::GetEmailTemp()->disclosure;
        
        ob_start();
        include 'emailtemplates/broker_temp.php';
        $this->broker_temp= ob_get_clean();
        ob_start();
        include 'emailtemplates/client_temp.php';
        $this->client_temp= ob_get_clean();
    }
}