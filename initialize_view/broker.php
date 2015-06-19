<?php
use broker\Broker,broker\BrokerDAO,utils\Session;
$user = Session::get('user_status');
$broker_info = BrokerDAO::GetBrokerInfo();
$broker = $broker_info?new Broker($broker_info):false;
$notice = Session::get('broker');
Session::unsets('broker');
