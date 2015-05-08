<?php
include 'config.php';

$broker=new \broker\Broker(\broker\BrokerDAO::GetBrokerInfo());

print_r($broker);

