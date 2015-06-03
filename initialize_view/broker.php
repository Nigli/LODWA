<?php
use broker\Broker,broker\BrokerDAO,utils\Session;
$user = Session::get('user_status');
$broker = new Broker(BrokerDAO::GetBrokerInfo());