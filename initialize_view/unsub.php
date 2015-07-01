<?php 
use receiver\ReceiverDao;

$subscriber = isset($_GET['id'])?ReceiverDao::getReceiverByHash($_GET['id']):'';