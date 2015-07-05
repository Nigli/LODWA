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
                $add_strat_fut = StrategyDAO::insertStrategyFuture($valid, $future_id);
            }
        }
        $update = StrategyDAO::updateStrategy($valid);
        $update ? Session::set("strategy", "update") : Session::set("strategy", "notupdate");
    } elseif ($valid['strategy-submit'] === "delete") {
        $remove_strat_fut = StrategyDAO::deleteStrategyFuture($valid);
        $remove_subscription = ReceiverDao::removeSubscriptionByStrategy($valid);
        $delete = StrategyDAO::removeStrategy($valid);
        $delete ? Session::set("strategy", "update") : Session::set("strategy", "notupdate");
    } else {
        $new = StrategyDAO::newStrategy($valid);
        if (isset($valid['futures_info'])) {
            foreach ($valid['futures_info'] as $k => $future_id) {
                $add_strat_fut = StrategyDAO::insertStrategyFuture($new, $future_id);
            }
        }
        $new ? Session::set("strategy", "update") : Session::set("strategy", "notupdate");
    }
} else {
    Session::set("future", "notupdate");
}
redirect_to("strategylist");
