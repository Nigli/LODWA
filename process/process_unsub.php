<?php
require '../config.php';
use utils\Validate,receiver\ReceiverDao;

$valid = Validate::unsub($_POST);
ReceiverDao::unsubscribeReceiver($valid);
redirect_to("unsub/");