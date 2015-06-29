<?php
use receiver\ReceiverDao,utils\Session,utils\Pagination;

$default_links = array( "p" => "receiverlist", "page" => "1", "active"=>"ALL", "type" => "0", "ba"=>"ALL");
$links = isset($_GET["page"])?$_GET:$default_links;
$user = Session::get('user_status');
$notice = Session::get('receiver');
Session::unsets('receiver');

$count = ReceiverDao::CountReceivers($links);
$pagin = new Pagination($links,$count);
$rec = ReceiverDao::GetReceivers($pagin,$links);
$type = ReceiverDao::GetTypes();
$user=='3'?include 'admin/receiverlist.php':'';