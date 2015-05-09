<?php
include 'config.php';
use sender\SenderInfo,sender\SenderInfoDAO;
$sender_info=new SenderInfo(SenderInfoDAO::GetSenderInfo());

print_r($sender_info);

