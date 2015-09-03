<?php

namespace controller;

use receiver\ReceiverDAO,
    utils\Validate;

class UnsubController extends MainController {

    public $subscriber;
    public $layout_unsub;

    public function __construct() {
        parent::__construct();
        $this->subscriber = isset($_GET['id']) ? ReceiverDAO::getReceiverByHash($_GET['id']) : FALSE;
        $this->layout_unsub = "view/unsub.php";
    }

    public function process($post) {
        $valid = Validate::unsub($post);
        $valid ? ReceiverDAO::unsubscribeReceiver($valid) : FALSE;
        ReceiverDAO::removeSubscriptionBySubscriber($valid['id_receiver']);
        redirect_to("unsub");
    }

}
