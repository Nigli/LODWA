<?php

namespace traderec;

use futures\FuturesContractDAO,
    strategy\StrategyDAO,
    traderec\TradeRecDAO;

class TradeRec {

    public $id_tr;
    public $fk_tr_type;
    public $rpl_price;
    public $tr_type_name;
    public $fk_future;
    public $fk_strategy;
    public $futures_name;
    public $month;
    public $year;
    public $num_contr;
    public $strategy_name;
    public $strategy_symbol;
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

    public function __construct($array = array()) {
        foreach ($array as $k => $v) {/*         * PUT ARRAY IN CONSTRUCT(form array)* */
            $this->$k = $v;
        }
        if ($this->rpl_price == "stop_loss") {/*         * IN CASE THAT TR IS CXL AND RPL CHANGE TR TYPE* */
            $this->fk_tr_type = "4";
        } else if ($this->rpl_price == "price_target") {
            $this->fk_tr_type = "3";
        }
        $future = FuturesContractDAO::getFuturesById($this->fk_future); /*         * GET FUTURE NAME AND STRATEGY BY ID TO USE IT FOR TR TITLE, STRATEGY NAME, DESCRIPTION...* */
        if ($future) {
            $this->title        = $this->entry_choice . " " . $future->futures_name . " " . $this->month . " " . $this->year;
            $this->futures_name = $future->futures_name;
            $this->description  = $future->description;
        }
        $strategy = StrategyDAO::getStrategyById($this->fk_strategy);
        $this->strategy_name    = $strategy ? $strategy->strategy_name : FALSE;
        $this->op_entry_choice  = ($this->entry_choice == "BUY") ? "SELL" : "BUY"; /*         * SET OPOSITE NAME FOR ENTRY CHOICE TO USE IT FOR EMAIL TEMPLATE* */
        $this->tr_type_name     = TradeRecDAO::getTradeRecType($this->fk_tr_type); /*         * GET TR TYPE NAME FROM TR TYPE ID* */
    }
    
    public static function logTRerrors($e) {
        $time       = date("Y-m-d H:i:s");
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $log        = $time . "|" . $ip_address . "|" . $e. "|"."\n";
        file_put_contents("log/errors/trerr.txt", $log, FILE_APPEND | LOCK_EX);
        return FALSE;
    }
}
