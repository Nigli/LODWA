<?php

namespace controller;

use strategy\StrategyDAO,
    futures\FuturesContractDAO,
    receiver\ReceiverDAO,
    utils\Validate,
    utils\Session;

class StrategylistController extends MainController {

    public $strategies;
    public $futures;
    public $strategy_form;

    public function __construct() {
        parent::__construct();
        $this->strategies       = StrategyDAO::getActiveStrategies(); /*         * GET STRATEGIES ARRAY OF OBJECTS* */
        $this->futures          = FuturesContractDAO::getActiveFutures(); /*         * GET FUTURES OBJECTS* */
        $this->strategy_form    = "view/manager/strategylist.php";
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        if ($valid) {/*         * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
            if ($valid['strategy-submit'] === "update") {
                $remove_strat_fut = StrategyDAO::deleteStrategyFuture($valid);
                if (isset($valid['futures_info'])) {
                    foreach ($valid['futures_info'] as $k => $future_id) {
                        $add_strat_fut = StrategyDAO::insertStrategyFuture($valid['id_strategy'], $future_id);
                    }
                }
                $update = StrategyDAO::updateStrategy($valid);
                $update ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } elseif ($valid['strategy-submit'] === "delete") {
                $remove_strat_fut       = StrategyDAO::deleteStrategyFuture($valid);
                $remove_subscription    = ReceiverDAO::removeSubscriptionByStrategy($valid);
                $delete                 = StrategyDAO::removeStrategy($valid);
                $delete ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } else {
                $new = StrategyDAO::newStrategy($valid);
                if (isset($valid['futures_info'])) {
                    foreach ($valid['futures_info'] as $k => $future_id) {
                        $add_strat_fut = StrategyDAO::insertStrategyFuture($new, $future_id);
                    }
                }
                $new ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            }
        } else {
            Session::set("notify", "notsent");
        }
        redirect_to("strategylist");
    }

}
