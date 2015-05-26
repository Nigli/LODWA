<?php
require 'config.php';
use broker\Broker,broker\BrokerDAO;
$broker = new Broker(BrokerDAO::GetBrokerInfo());
var_dump($broker);