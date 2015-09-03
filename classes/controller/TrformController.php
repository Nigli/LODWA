<?php

namespace controller;

use traderec\TradeRec,
    traderec\TradeRecDAO,
    futures\FuturesContractDAO,
    utils\Validate,
    email\Email,
    utils\Enum,
    utils\Session;

class TrformController extends MainController {

    public $futures;
    public $last5TR;
    public $lastTR;

    public function __construct() {
        parent::__construct();
        $this->futures = FuturesContractDAO::getActiveFutures(); /*         * GETS ARRAY OF FUTURES OBJECTS* */
        $this->last5TR = TradeRecDAO::getLast5TradeRecs(); /*         * GETS ARRAY OF 5 TR OBJECTS* */
        $this->last5TR ? $this->lastTR = $this->last5TR[0] : null;        
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid = Validate::tr($post);
        $tr = $valid ? new TradeRec($valid) : false; /*         * IF IS VALID IS OK CREATE NEW TR OBJECT* */
        $email = $tr ? new Email($tr) : false; /*         * IF TR IS OK CREATE NEW EMAIL OBJECT* */
        $sent = $email ? $email->sendEmail($email) : false; /*         * IF EMAIL OBJECT CREATED SEND EMAIL WITH sendEmail() method* */
        $insert = ($sent) ? TradeRecDAO::insertTradeRec($email) : false;
        $insert ? Session::set("notify", "sent") : Session::set("notify", "notsent");
        redirect_to("trade");
    }
}
