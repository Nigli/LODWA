<?php

require '../function_phpmailer.php';
require '../config.php';

use traderec\TradeRec,
    traderec\TradeRecDAO,
    utils\Validate,
    email\Email,
    utils\Session;

$valid = Validate::tr($_POST);
$tr = $valid ? new TradeRec($valid) : false; /* * IF IS VALID IS OK CREATE NEW TR OBJECT* */
$email = $tr ? new Email($tr) : false; /* * IF TR IS OK CREATE NEW EMAIL OBJECT* */
$sent = $email ? phpmailer($email) : false; /* * IF EMAIL OBJECT CREATED SEND EMAIL WITH phpmailer() function* */
$insert = ($sent) ? TradeRecDAO::insertTradeRec($email) : false;
$insert ? Session::set("tr", "sent") : Session::set("tr", "notsent");
redirect_to("trade");
