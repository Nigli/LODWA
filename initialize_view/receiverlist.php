<?php
use receiver\ReceiverDao,utils\Session,utils\Pagination;

$links = isset($_GET)?$_GET:"";
$user = Session::get('user_status');
$notice = Session::get('receiver');
Session::unsets('receiver');

$count = ReceiverDao::CountReceivers($links);
$pagin = new Pagination($links,$count);
$rec = ReceiverDao::GetActiveReceivers($pagin,$links);
$type = ReceiverDao::GetTypes();
$user=='3'?include 'admin/receiverlist.php':'';