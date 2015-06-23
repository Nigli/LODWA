<?php 
use receiver\ReceiverDao;

$subscriber = isset($_GET['id'])?ReceiverDao::GetReceiverByHash($_GET['id']):'';