<?php
namespace traderec;
class TradeRec {
    public $id_tr;
    public $fk_tr_type;
    public $fk_future;
    public $futures_name;
    public $month;
    public $year;
    public $num_contr;
    public $tr_program;
    public $description;
    public $entry_choice;
    public $entry_price;
    public $price_target;
    public $stop_loss;
    public $date;
    public $time;
    public $title;
    
    public function __construct($array = array()) {
        foreach($array as $k=>$v){
            $this->$k = $v;
            $this->title="Trade Recommendation: ".$this->entry_choice." ".$this->futures_name." ".$this->month;
        }        
    }    
}
