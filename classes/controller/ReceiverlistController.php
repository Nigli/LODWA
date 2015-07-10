<?php

namespace controller;

use receiver\ReceiverDao,
    receiver\Receiver,
    utils\Pagination,
    strategy\StrategyDao,
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
            $this->count = ReceiverDao::countReceivers($this->links);
            $this->pagin = new Pagination($this->links, $this->count);
            $this->rec = ReceiverDao::getReceivers($this->pagin, $this->links);
            if ($this->rec) {
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
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        if ($valid) {/*         * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
            $receiver = new Receiver($valid);
            if ($valid['receiver-submit'] === "update") {
                $update = ReceiverDao::updateReceiver($receiver);
                $remove_subs = ReceiverDao::removeSubscriptionBySubscriber($receiver->id_receiver);
                $has_sub = false;
                foreach ($receiver->subs_info as $strategy_id => $num_subscriptions) {
                    if ($num_subscriptions != 0) {
                        $subs = ReceiverDao::insertSubscription($receiver->id_receiver, $strategy_id, $num_subscriptions);
                        $has_sub = true;
                        $update && $remove_subs && $subs ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                    }
                }
                if (!$has_sub) {
                    $unsub = ReceiverDao::unsubscribeReceiver($valid);
                    $update && $remove_subs && $unsub ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                }
            } elseif ($valid['receiver-submit'] === "unsubscribe") {
                $unsub = ReceiverDao::unsubscribeReceiver($valid);
                $remove_subs = ReceiverDao::removeSubscriptionBySubscriber($receiver->id_receiver);
                $remove_subs && $unsub ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } else {
                $new = ReceiverDao::newReceiver($receiver);
                $has_sub = false;
                foreach ($receiver->subs_info as $strategy_id => $num_subscriptions) {
                    if ($num_subscriptions != 0) {
                        $subs = ReceiverDao::insertSubscription($new, $strategy_id, $num_subscriptions);
                        $has_sub = true;
                        $new && $remove_subs && $subs ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                    }
                }
                if (!$has_sub) {
                    $unsub = ReceiverDao::unsubscribeReceiver($valid);
                    $new && $remove_subs && $unsub ? Session::set("notify", "sent") : Session::set("notify", "notsent");
                }
            }
        } else {
            Session::set("notify", "notsent");
        }
        redirect_to("receiverlist");
    }

}
