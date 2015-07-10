<?php

namespace controller;

use receiver\ReceiverDao,
    utils\Validate;

class UnsubController extends MainController {

    public $subscriber;
    public $layout_unsub;

    public function __construct() {
        parent::__construct();
        $this->subscriber = isset($_GET['id']) ? ReceiverDao::getReceiverByHash($_GET['id']) : FALSE;
        $this->layout_unsub = "view/unsub.php";
    }

    public function process($post) {
        $valid = Validate::unsub($post);
        $valid ? ReceiverDao::unsubscribeReceiver($valid) : FALSE;
        ReceiverDao::removeSubscriptionBySubscriber($valid['id_receiver']);
        redirect_to("unsub");
    }

}
