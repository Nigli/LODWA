<?php
namespace email;
use sender\SenderInfo,sender\SenderInfoDAO,broker\Broker,broker\BrokerDAO,receiver\ReceiverDao,email\EmailTempDAO;

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
            $this->recipients[]=$v->recipient;
        }
        $this->num_tot_contr=ReceiverDao::GetClientsSubs($tr->fk_future, $tr->num_contr);
        $this->subscribers=ReceiverDao::GetSubscribers($this->id_strategy);
        $this->disclosure=EmailTempDAO::GetEmailTemp()->disclosure;        
    }
    public static function TempView($email){
        ob_start();
        include '../view/block_breakdown.php';
        $block_breakdown = ob_get_clean();
        
        $elements_in = array($email->title,$email->tr_type_name,$email->date,$email->time,$email->strategy_name,$email->month,$email->futures_name,$email->entry_choice,$email->op_entry_choice,$email->duration,$email->entry_price,$email->price_target,$email->stop_loss,$email->description,$email->disclosure,$email->sender_email,$email->company_website,$email->company_name,$email->sender_address,$block_breakdown);
        $elements_out = array('[TITLE]','[TRADE_TYPE]','[DATE]','[TIME]','[STRATEGY]','[MONTH]','[FUTURE]','[ENTRY_CHOICE]','[OP_ENTRY_CHOICE]','[DURATION]','[ENTRY_PRICE]','[PRICE_TARGET]','[STOP_LOSS]','[DESCRIPTION]','[DISCLOSURE]','[SENDER_EMAIL]','[COMPANY_WEBSITE]','[COMPANY_NAME]','[ADDRESS]','[BLOCK_BREAKDOWN]');
        
        $broker_temp_view = file_get_contents('../emailtemplates/broker_temp.php');
        $broker_temp = str_replace($elements_out, $elements_in, $broker_temp_view);
        
        $client_temp_view = file_get_contents('../emailtemplates/client_temp.php');
        $client_temp = str_replace($elements_out, $elements_in, $client_temp_view);
        return $temps=array($broker_temp,$client_temp);
    }
}