<?php
require '../config.php';
use broker\BrokerDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
$broker= $valid?BrokerDAO::editBrokerInfo($valid):FALSE;
$broker?Session::set("notify", "sent"):Session::set("notify", "notsent");
redirect_to("broker");