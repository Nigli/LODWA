<?php

namespace controller;

use futures\FuturesContractDAO,
    utils\Validate,
    utils\Session;

class FutureslistController extends MainController {

    public $future;
    public $futures_form;

    public function __construct() {
        parent::__construct();
        $this->future       = FuturesContractDAO::getActiveFutures(); /*         * GET FUTURES INFO OBJECT* */
        $this->futures_form = "view/manager/futureslist.php";
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::manager($post);
        if ($valid) {/*         * CHECKS IF VALID IS OK, THEN BASED ON SUBMIT BUTTON VALUE CALLING DAO* */
            if ($valid['futures-submit'] === "update") {
                $update = FuturesContractDAO::updateFutures($valid);
                $update ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } elseif ($valid['futures-submit'] === "delete") {
                $remove_strat_fut = FuturesContractDAO::deleteStrategyFuture($valid);
                $delete = FuturesContractDAO::removeFutures($valid);
                $delete ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            } else {
                $new = FuturesContractDAO::newFutures($valid);
                $new ? Session::set("notify", "sent") : Session::set("notify", "notsent");
            }
        } else {
            Session::set("notify", "notsent");
        }
        redirect_to("futureslist");
    }

}
