<?php
require '../config.php';
use broker\BrokerDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
$broker= $valid?BrokerDAO::editBrokerInfo($valid):FALSE;
$broker?Session::set("broker", "sent"):Session::set("broker", "notsent");
redirect_to("broker");