<?php
namespace traderec;
use futures\FuturesContractDAO,traderec\TradeRecDAO;
class TradeRec {
    public $id_tr;
    public $fk_tr_type;
    public $rpl_price;
    public $tr_type_name;
    public $fk_future;
    public $futures_name;
    public $month;
    public $year;
    public $num_contr;
    public $id_strategy;
    public $strategy_name;
    public $description;
    public $entry_choice;
    public $op_entry_choice;
    public $duration;
    public $entry_price;
    public $price_target;
    public $stop_loss;
    public $date;
    public $time;
    public $title;
    
    public function __construct($array=array()) {
        foreach($array as $k=>$v){/**PUT ARRAY IN CONSTRUCT(form array)**/
            $this->$k = $v;
        }
        if($this->rpl_price == "stop_loss"){/**IN CASE THAT TR IS CXL AND RPL CHANGE TR TYPE**/
            $this->fk_tr_type = "4";
        }elseif ($this->rpl_price == "price_target") {
            $this->fk_tr_type = "3";
        }
        $future = FuturesContractDAO::getFuturesById($this->fk_future); /**GET FUTURE NAME AND STRATEGY BY ID TO USE IT FOR TR TITLE, STRATEGY NAME, DESCRIPTION...**/
        $this->title=$this->entry_choice." ".$future->futures_name." ".$this->month." ".$this->year;      
        $this->futures_name = $future->futures_name;
        $this->id_strategy = $future->fk_strategy;
        $this->strategy_name = $future->strategy_name;
        $this->description = $future->description;
        $this->op_entry_choice=($this->entry_choice=="BUY")?"SELL":"BUY";/**SET OPOSITE NAME FOR ENTRY CHOICE TO USE IT FOR EMAIL TEMPLATE**/
        $this->tr_type_name=TradeRecDAO::getTradeRecType($this->fk_tr_type);/**GET TR TYPE NAME FROM TR TYPE ID**/
    }    
}
