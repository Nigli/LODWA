<?php
use sender\SenderInfoDAO,sender\SenderInfo,utils\Session;

$user = Session::get('user_status');
$notice = Session::get('profile');
Session::unsets('profile');

$sender_info = SenderInfoDAO::GetSenderInfo();
$sender = $sender_info?new SenderInfo($sender_info):false;