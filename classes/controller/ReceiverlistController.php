<?php

namespace controller;

use receiver\ReceiverDAO,
    receiver\Receiver,
    utils\Pagination,
    strategy\StrategyDAO,
    utils\Validate,
    utils\Session;

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
            $this->count    = ReceiverDAO::countReceivers($this->links);
            $this->pagin    = new Pagination($this->links, $this->count);
            $this->rec      = ReceiverDAO::getReceivers($this->pagin, $this->links);
            if ($this->rec) {
                foreach ($this->rec as $receiver) {
                    $receiver->subs_info = ReceiverDAO::getSubscriptionBySubsId($receiver->id_receiver);
                }
            }
        } else {
            $this->count = ReceiverDAO::countInactiveReceivers($this->links);
            $this->pagin = new Pagination($this->links, $this->count);
            $this->rec = ReceiverDAO::getInactiveReceivers($this->pagin, $this->links);
        }
        $this->type         = ReceiverDAO::getTypes();
        $this->strategies   = StrategyDAO::getActiveStrategies();
        $this->receiver_form = "view/manager/receiverlist.php";
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        if ($valid) {/*         * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
            $receiver = new Receiver($valid);
            if ($valid['receiver-submit'] === "update") {
                $update = ReceiverDAO::updateReceiver($receiver);
                $remove_subs = ReceiverDAO::removeSubscriptionBySubscriber($receiver->id_receiver);
                $has_sub = false;
                foreach ($receiver->subs_info as $strategy_id => $num_subscriptions) {
                    if ($num_subscriptions != 0) {
                        $subs       = ReceiverDAO::insertSubscription($receiver->id_receiver, $strategy_id, $num_subscriptions);
                        $has_sub    = true;
                        $update && $remove_subs && $subs ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                    }
                }
                if (!$has_sub) {
                    $unsub = ReceiverDAO::unsubscribeReceiver($valid);
                    $update && $remove_subs && $unsub ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                }
            } elseif ($valid['receiver-submit'] === "unsubscribe") {
                $unsub          = ReceiverDAO::unsubscribeReceiver($valid);
                $remove_subs    = ReceiverDAO::removeSubscriptionBySubscriber($receiver->id_receiver);
                $remove_subs && $unsub ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } else {
                $new = ReceiverDAO::newReceiver($receiver);
                $has_sub = false;
                foreach ($receiver->subs_info as $strategy_id => $num_subscriptions) {
                    if ($num_subscriptions != 0) {
                        $subs       = ReceiverDAO::insertSubscription($new, $strategy_id, $num_subscriptions);
                        $has_sub    = true;
                        $new && $subs ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                    }
                }
                if (!$has_sub) {
                    $unsub = ReceiverDAO::unsubscribeReceiver($valid);
                    $new && $unsub ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                }
            }
        } else {
            Session::set("notify", "notsent");
        }
        redirect_to("receiverlist");
    }

}
