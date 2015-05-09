<?php
include 'config.php';
use broker\Broker,broker\BrokerDAO;
$broker=new Broker(BrokerDAO::GetBrokerInfo());

print_r($broker);

