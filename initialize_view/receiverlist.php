<?php
use receiver\ReceiverDao,utils\Session, utils\Pagination;

$count = ReceiverDao::CountReceivers();
$links = isset($_GET)?$_GET:"nije setovana";
$pagin = new Pagination($links,$count);
$rec = ReceiverDao::GetActiveReceivers($pagin);
$type = ReceiverDao::GetTypes();
$user = Session::get('user_status');
$user=='3'?include 'admin/receiverlist.php':'';