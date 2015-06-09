<?php
namespace traderec;
use futures\FuturesContractDAO,traderec\TradeRecDAO;
class TradeRec {
    public $id_tr;
    public $fk_tr_type;
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
        foreach($array as $k=>$v){
            $this->$k = $v;
        }
        $future = FuturesContractDAO::GetFuturesById($this->fk_future);
        $this->title=$this->entry_choice." ".$future->futures_name." ".$this->month." ".$this->year;      
        $this->futures_name = $future->futures_name;
        $this->id_strategy = $future->fk_strategy;
        $this->strategy_name = $future->strategy_name;
        $this->description = $future->description;
        $this->op_entry_choice=($this->entry_choice=="BUY")?"SELL":"BUY";
        $this->tr_type_name=TradeRecDAO::GetTradeRecType($this->fk_tr_type);
    }    
}
