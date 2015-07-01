<?php
use broker\Broker,broker\BrokerDAO,utils\Session;

$user = Session::get('user_status');/**GETS USER STATUS**/
$notice = Session::get('broker');/**GETS NOTICE(creates notice var to use it in notification popup) FROM SESSION WITH INFO BROKER SUCCESS**/
Session::unsets('broker');

$broker = BrokerDAO::getBrokerInfo();/**GET BROKER INFO OBJECT**/