<?php
namespace traderec;
use futures\FuturesContractDAO;
class TradeRec {
    public $id_tr;
    public $fk_tr_type;
    public $tr_type_name;
    public $fk_future;
    public $futures_name;
    public $month;
    public $year;
    public $num_contr;
    public $tr_program_name;
    public $description;
    public $entry_choice;
    public $duration;
    public $entry_price;
    public $price_target;
    public $stop_loss;
    public $date;
    public $time;
    public $title;
    
    public function __construct($array = array()) {
        if(isset($array['fk_future'])){
            $future = FuturesContractDAO::GetFuturesById($array['fk_future']);
        }
        foreach($array as $k=>$v){
            $this->$k = $v;
            $this->title=$this->tr_type_name.": ".$this->entry_choice." ".$future->futures_name." ".$this->month;
            $this->tr_type_name=TradeRecDAO::GetTradeRecType($this->fk_tr_type);
            $this->futures_name = $future->futures_name;
            $this->tr_program_name = $future->tr_program_name;
            $this->description = $future->description;
            $this->date = date("j F Y");
            $this->time = date("Gi");
        }
    }    
}
