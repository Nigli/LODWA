<?php
use receiver\ReceiverDao,utils\Session, utils\Pagination;

$links = isset($_GET)?$_GET:"nije setovana";
$count = ReceiverDao::CountReceivers($links);
$pagin = new Pagination($links,$count);
$rec = ReceiverDao::GetActiveReceivers($pagin,$links);
$type = ReceiverDao::GetTypes();
$user = Session::get('user_status');
$user=='3'?include 'admin/receiverlist.php':'';