<?php

namespace controller;

use receiver\ReceiverDao,
    utils\Pagination,
    strategy\StrategyDao;

class ReceiverlistController extends MainController {

    public $rec;
    public $count;
    public $links = array();
    public $pagin;
    public $type;
    public $strategies;
    public $receiver_form;

    public function __construct() {
        parent::__construct();
        $this->links = isset($_GET["page"]) ? $_GET : $this->default_receiver_filter;
        if ($this->links['active'] == 1) {
            $this->count = ReceiverDao::countReceivers($this->links);
            $this->pagin = new Pagination($this->links, $this->count);
            $this->rec = ReceiverDao::getReceivers($this->pagin, $this->links);
            if($this->rec){
                foreach ($this->rec as $receiver) {
                    $receiver->subs_info = ReceiverDao::getSubscriptionBySubsId($receiver->id_receiver);
                }            
            }
        } else {
            $this->count = ReceiverDao::countInactiveReceivers($this->links);
            $this->pagin = new Pagination($this->links, $this->count);
            $this->rec = ReceiverDao::getInactiveReceivers($this->pagin, $this->links);
        }
        $this->type = ReceiverDao::getTypes();
        $this->strategies = StrategyDao::getActiveStrategies();
        $this->receiver_form = "view/manager/receiverlist.php";
    }

}
