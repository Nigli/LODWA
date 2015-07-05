<?php
namespace email;
use sender\SenderInfoDAO,broker\BrokerDAO,receiver\ReceiverDao,email\EmailTempDAO,utils\Render;

class Email{
    public $fk_tr_type;
    public $tr_type_name;
    public $rpl_price;
    public $title;
    public $date_time;
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
        foreach($tr as $k=>$v){/**PUT OBJECT IN CONSTRUCT(TR OBJECT)**/
            $this->$k = $v;
        }    
        
        date_default_timezone_set(CHICAGO_TIME);/**SETTING TIME ZONE TO BE CHICAGO(constant from config file)**/
        $date_time = new \DateTime();/**CREATE NEW DATETIME OBJECT AND FORMAT IT FOR DB**/
        $this->date_time = $date_time->format("Y-m-d H:i:s");
        $this->date = $date_time->format("d M Y");
        $this->time = $date_time->format("H:i");
                
        foreach(SenderInfoDAO::getSenderInfo() as $k=>$v){/**CREATES SENDER INFO OBJECT**/
            $this->$k = $v;
        }
        foreach(BrokerDAO::getBrokerInfo() as $k=>$v){/**CREATES BROKER INFO OBJECT**/
            $this->$k = $v;
        }
        foreach(ReceiverDao::getReceiversByStrat($this->id_strategy) as $k=>$v){/**CREATES ARRAY OF CLIENT OBJECTS**/
            $this->hash_email = $v->hash_email;
            $this->id_receiver = $v->id_receiver;
            $this->recipients[]=$v->recipient;
        }
        
        $this->disclosure=Email::nl2p(EmailTempDAO::getEmailTemp()->disclosure);/**CREATES OBJECT AND APPLY nl2p function on DISCLOSURE PROPERTY**/
        $temps = Render::viewTemp($this);
        $this->broker_temp=$temps[0];
        $this->client_temp=$temps[1];
    }
    private static function nl2p($text){/**SET ALL LETTERS UPPER AND REPLACE \n WITH <p> TAGS**/
        $uptext= strtoupper($text);
        return "<p>" . str_replace("\n", "</p><p>", $uptext) . "</p>";
    }
}