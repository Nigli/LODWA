<?php
namespace email;
use sender\SenderInfo,sender\SenderInfoDAO,broker\Broker,broker\BrokerDAO,receiver\ReceiverDao,email\EmailTemp;

class Email{
    public $id_sender;
    public $company_name;
    public $sender_first_name;
    public $sender_last_name;
    public $sender_host;
    public $sender_email;
    public $sender_pass;
    public $sender_port;
    public $sender_from;
    public $sender_address;
    
    public $id_broker;
    public $broker_first_name;
    public $broker_last_name;
    public $broker_email;
    public $broker_to;
    
    public $recipients=array();
    public $title;
    public $num_subs;
    public $tr_type_name;
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

        $elements_in = array($this->title,$tr->tr_type_name,$this->num_subs,$tr->date,$tr->time,$tr->tr_program_name,$tr->month,$tr->futures_name,$tr->entry_choice,$tr->entry_price,$tr->price_target,$tr->stop_loss,$tr->description,$this->disclosure,$this->sender_email,$this->company_website,$this->company_name,$this->sender_address);
        $elements_out = array('[TITLE]','[TRADE_TYPE]','[BLOCK_ORDER]','[DATE]','[TIME]','[PROGRAM]','[MONTH]','[FUTURE]','[ENTRY_CHOICE]','[ENTRY_PRICE]','[PRICE_TARGET]','[STOP_LOSS]','[DESCRIPTION]','[DISCLOSURE]','[SENDER_EMAIL]','[COMPANY_WEBSITE]','[COMPANY_NAME]','[ADDRESS]');
        
        $broker_temp = file_get_contents('../emailtemplates/broker_temp.php');
        $this->broker_temp = str_replace($elements_out, $elements_in, $broker_temp);
        
        $client_temp = file_get_contents('../emailtemplates/client_temp.php');
        $this->client_temp = str_replace($elements_out, $elements_in, $client_temp);
    }
}