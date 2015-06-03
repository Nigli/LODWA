<?php
require '../config.php';
use broker\BrokerDAO,utils\Validate;
$valid = Validate::admin($_POST);
BrokerDAO::EditBrokerInfo($valid);
