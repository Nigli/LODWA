<?php
require 'config.php';
use receiver\Receiver,receiver\ReceiverDao;

var_dump(ReceiverDao::GetActiveReceivers());
echo "<br>";
