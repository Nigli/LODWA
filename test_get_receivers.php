<?php
require 'config.php';
print_r(ReceiverDao::GetActiveReceivers());
$test = ReceiverDao::GetActiveReceivers();
echo "<br>";
$test[0]->date();
