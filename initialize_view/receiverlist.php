<?php
use receiver\ReceiverDao,utils\Session;
$rec = ReceiverDao::GetActiveReceivers();
$type = ReceiverDao::GetTypes();
$user = Session::get('user_status');
$user=='3'?include 'admin/receiverlist.php':'';