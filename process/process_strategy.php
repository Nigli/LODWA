<?php

require '../config.php';

use strategy\StrategyDAO,
    receiver\ReceiverDao,
    utils\Validate,
    utils\Session;

var_dump($_POST);
$valid = Validate::admin($_POST);
if ($valid) {/* * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
    if ($valid['strategy-submit'] === "update") {
        $remove_strat_fut = StrategyDAO::deleteStrategyFuture($valid);
        if (isset($valid['futures_info'])) {
            foreach ($valid['futures_info'] as $k => $future_id) {
                $add_strat_fut = StrategyDAO::insertStrategyFuture($valid['id_strategy'], $future_id);
            }
        }
        $update = StrategyDAO::updateStrategy($valid);
        $update ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    } elseif ($valid['strategy-submit'] === "delete") {
        $remove_strat_fut = StrategyDAO::deleteStrategyFuture($valid);
        $remove_subscription = ReceiverDao::removeSubscriptionByStrategy($valid);
        $delete = StrategyDAO::removeStrategy($valid);
        $delete ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    } else {
        $new = StrategyDAO::newStrategy($valid);
        if (isset($valid['futures_info'])) {
            foreach ($valid['futures_info'] as $k => $future_id) {
                $add_strat_fut = StrategyDAO::insertStrategyFuture($new, $future_id);
            }
        }
        $new ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    }
} else {
    Session::set("notify", "notupdate");
}
redirect_to("strategylist");
