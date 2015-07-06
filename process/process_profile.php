<?php
require '../config.php';
use sender\SenderInfoDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
$sender = $valid?SenderInfoDAO::editSenderInfo($valid):false;
$sender?Session::set("notify", "sent"):Session::set("notify", "notsent");
redirect_to("profile");