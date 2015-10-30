<?php

namespace controller;

use traderec\TradeRecDAO,
    utils\Pagination,
    utils\Validate,
    utils\Session,
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
        $this->trresult_form = 'view/manager/trresult.php';
        $this->links = isset($_GET["page"]) ? $_GET : $this->default_trlist_filter;
        $this->count = TradeRecDAO::countTrades($this->links);
        $this->pagin = new Pagination($this->links, $this->count);
        $this->lastTR = TradeRecDAO::getTradeRecs($this->pagin, $this->links);
        $this->listnumb = $this->pagin->offset;
        $this->futures = FuturesContractDAO::getActiveFutures();
        $this->unsetNotice("notify");
    }
    public function process($post) {
        $valid = Validate::manager($post);
        $update = $valid ? TradeRecDAO::setTradeRecResult($valid) : false;
        $update ? Session::set("notify", "sent") : Session::set("notify", "notsent");
        redirect_to("trlist");
    }

}
