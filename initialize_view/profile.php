<?php
use sender\SenderInfoDAO,utils\Session;

$user = Session::get('user_status');/**GETS USER STATUS**/
$notice = Session::get('profile');/**GETS NOTICE(creates notice var to use it in notification popup) FROM SESSION WITH INFO PROFILE SUCCESS**/
Session::unsets('profile');

$sender = SenderInfoDAO::getSenderInfo();/**GET SENDER INFO OBJECT**/