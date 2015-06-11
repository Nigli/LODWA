<?php
namespace email;
use sender\SenderInfo,sender\SenderInfoDAO,broker\Broker,broker\BrokerDAO,receiver\ReceiverDao,email\EmailTempDAO,utils\Render;

class Email{
    public $tr_type_name;
    public $title;
    public $date;
    public $time;
    public $id_strategy;
    public $strategy_name;
    public $month;
    public $futures_name;
    public $entry_choice;
    public $op_entry_choice;
    public $duration;
    public $entry_price;
    public $price_target;
    public $stop_loss;
    public $description;
    public $num_contr;
    public $num_tot_contr;
    public $subscribers=array();
    
    public $id_sender;
    public $company_name;
    public $sender_name;
    public $sender_host;
    public $sender_email;
    public $sender_pass;
    public $sender_port;
    public $sender_address;
    
    public $id_broker;
    public $broker_company;    
    public $company_website;
    public $broker_name;
    public $broker_email;
    
    public $id_receiver;
    public $hash_email;
    public $recipients=array();
    public $disclosure;
    
    public $broker_temp;
    public $client_temp;
    
    public function __construct($tr) {
        foreach($tr as $k=>$v){
            $this->$k = $v;
        }
        $sender_info=new SenderInfo(SenderInfoDAO::GetSenderInfo());
        foreach($sender_info as $k=>$v){
            $this->$k = $v;
        }
        $broker_info = new Broker(BrokerDAO::GetBrokerInfo());
        foreach($broker_info as $k=>$v){
            $this->$k = $v;
        }
        foreach (ReceiverDao::GetClientsReceivers() as $k=>$v){
            $this->hash_email = $v->hash_email;
            $this->id_receiver = $v->id_receiver;
            $this->recipients[]=$v->recipient;
        }
        $this->num_tot_contr=ReceiverDao::GetClientsSubs($tr->fk_future, $tr->num_contr);
        $this->subscribers=ReceiverDao::GetSubscribers($this->id_strategy);
        $this->disclosure=Email::nl2p(EmailTempDAO::GetEmailTemp()->disclosure);
        $temps = Render::ViewTemp($this);
        $this->broker_temp=$temps[0];
        $this->client_temp=$temps[1];
    }
    public static function nl2p($text){
        $uptext= strtoupper($text);
        return "<p>" . str_replace("\n", "</p><p>", $uptext) . "</p>";
    }
}