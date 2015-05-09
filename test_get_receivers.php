<?php
require 'config.php';
use receiver\Receiver,receiver\ReceiverDao;

print_r(ReceiverDao::GetActiveReceivers());
$test = ReceiverDao::GetActiveReceivers();
echo "<br>";