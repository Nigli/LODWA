<?php

namespace strategy;

use futures\FuturesContractDAO;

class Strategy {

    public $id_strategy;
    public $strategy_name;
    public $futures_info = array();

    public function __construct() {
        $futures = FuturesContractDAO::getFuturesByStrategy($this->id_strategy);
        foreach ($futures as $k => $future) {
            $this->futures_info[$future->id_futures] = $future->futures_name;
        }
    }

}
