<?php

use receiver\ReceiverDao,
    utils\Session,
    utils\Pagination,
    strategy\StrategyDao;

$default_links = array("p" => "receiverlist", "page" => "1", "active" => "1", "type" => "0", "strategy" => "0", "ba" => "ALL");
$links = isset($_GET["page"]) ? $_GET : $default_links;
$user = Session::get('user_status');
$notice = Session::get('receiver');
Session::unsets('receiver');
if ($links["active"] == 1) {
    $count = ReceiverDao::countReceivers($links);
    $pagin = new Pagination($links, $count);
    $rec = ReceiverDao::getReceivers($pagin, $links);
    if($rec){
        foreach ($rec as $receiver) {
            $receiver->subs_info = ReceiverDao::getSubscriptionBySubsId($receiver->id_receiver);
        }    
    }
} else {
    $count = ReceiverDao::countInactiveReceivers($links);
    $pagin = new Pagination($links, $count);
    $rec = ReceiverDao::getInactiveReceivers($pagin, $links);
}
$type = ReceiverDao::getTypes();
$strategies = StrategyDao::getActiveStrategies();
$user == '3' ? include 'admin/receiverlist.php' : '';
