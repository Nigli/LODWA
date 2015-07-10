<?php

namespace controller;

use traderec\TradeRecDAO,
    utils\Pagination,
    futures\FuturesContractDAO;

class TrlistController extends MainController {

    public $lastTR;
    public $count;
    public $links = array();
    public $pagin;
    public $listnumb;
    public $futures;

    public function __construct() {
        parent::__construct();
        $this->links = isset($_GET["page"]) ? $_GET : $this->default_trlist_filter;
        $this->count = TradeRecDAO::countTrades($this->links);
        $this->pagin = new Pagination($this->links, $this->count);
        $this->lastTR = TradeRecDAO::getTradeRecs($this->pagin, $this->links);
        $this->listnumb = $this->pagin->offset;
        $this->futures = FuturesContractDAO::getActiveFutures();
    }
    

}
