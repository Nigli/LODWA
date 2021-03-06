<?php

namespace strategy;

use futures\FuturesContractDAO,
    receiver\ReceiverDAO,
    utils\Enum;

class Strategy {

    public $id_strategy;
    public $strategy_name;
    public $strategy_symbol;
    public $num_tr_day;
    public $start_time;
    public $end_time;
    public $cxr_start_time;
    public $cxr_end_time;
    public $num_tr_day_status;
    public $num_futures;
    public $num_receivers;
    public $tr_time_status;
    public $cxr_time_status;
    public $auto_tr;
    public $num_contracts;
    public $futures_info = array();

    public function __construct() {
        $futures = FuturesContractDAO::getFuturesByStrategy($this->id_strategy);
        foreach ($futures as $k => $future) {/**/
            $this->futures_info[$future->id_futures] = $future->futures_name;
        }
        $this->num_futures = count($futures);
        $receivers = ReceiverDAO::getReceiversByStrat($this->id_strategy);
        $this->num_receivers = count($receivers);
    }

}
