<?php
use sender\SenderInfoDAO,sender\SenderInfo,utils\Session;
$user = Session::get('user_status');
$sender = new SenderInfo(SenderInfoDAO::GetSenderInfo());
