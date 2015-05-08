<?php
include 'config.php';

$sender_info=new \sender\SenderInfo(\sender\SenderInfoDAO::GetSenderInfo());

print_r($sender_info);

