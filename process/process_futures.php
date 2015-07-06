<?php

require '../config.php';

use futures\FuturesContractDAO,
    utils\Validate,
    utils\Session;

$valid = Validate::admin($_POST);
if ($valid) {/* * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
    if ($valid['futures-submit'] === "update") {
        $update = FuturesContractDAO::updateFutures($valid);
        $update ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    } elseif ($valid['futures-submit'] === "delete") {
        $remove_strat_fut = FuturesContractDAO::deleteStrategyFuture($valid);
        $delete = FuturesContractDAO::removeFutures($valid);
        $delete ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    } else {
        $new = FuturesContractDAO::newFutures($valid);
        $new ? Session::set("notify", "update") : Session::set("notify", "notupdate");
    }
} else {
    Session::set("notify", "notupdate");
}
redirect_to("futureslist");
