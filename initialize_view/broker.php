<?php
use broker\Broker,broker\BrokerDAO,utils\Session;

$user = Session::get('user_status');
$notice = Session::get('broker');
Session::unsets('broker');

$broker_info = BrokerDAO::GetBrokerInfo();
$broker = $broker_info?new Broker($broker_info):false;