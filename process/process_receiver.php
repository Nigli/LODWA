<?php

require '../config.php';

use receiver\ReceiverDao,
    receiver\Receiver,
    utils\Validate,
    utils\Session;

$valid = Validate::admin($_POST);
if ($valid) {/* * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
    $receiver = new Receiver($valid);
    if ($valid['receiver-submit'] === "update") {
        $update = ReceiverDao::updateReceiver($receiver);
        $remove_subs = ReceiverDao::removeSubscriptionBySubscriber($receiver->id_receiver);
        $has_sub = false;
        foreach ($receiver->subs_info as $strategy_id => $num_subscriptions) {
            if ($num_subscriptions != 0) {
                $subs = ReceiverDao::insertSubscription($receiver->id_receiver, $strategy_id, $num_subscriptions);
                $has_sub = true;
                $update && $remove_subs && $subs ? Session::set("notify", "update") : Session::set("notify", "notupdate");
            }
        }
        if (!$has_sub) {
            $unsub = ReceiverDao::unsubscribeReceiver($valid);
            $update && $remove_subs && $unsub ? Session::set("notify", "update") : Session::set("notify", "notupdate");
        }
    } elseif ($valid['receiver-submit'] === "unsubscribe") {
        $unsub = ReceiverDao::unsubscribeReceiver($valid);
        $remove_subs = ReceiverDao::removeSubscriptionBySubscriber($receiver->id_receiver);
        $remove_subs && $unsub ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    } else {
        $new = ReceiverDao::newReceiver($receiver);
        $has_sub = false;
        foreach ($receiver->subs_info as $strategy_id => $num_subscriptions) {
            if ($num_subscriptions != 0) {
                $subs = ReceiverDao::insertSubscription($new, $strategy_id, $num_subscriptions);
                $has_sub = true;
                $new && $remove_subs && $subs ? Session::set("notify", "update") : Session::set("notify", "notupdate");
            }
        }
        if (!$has_sub) {
            $unsub = ReceiverDao::unsubscribeReceiver($valid);
            $new && $remove_subs && $unsub ? Session::set("notify", "update") : Session::set("notify", "notupdate");
        }
    }
} else {
    Session::set("notify", "notupdate");
}
redirect_to("receiverlist");
