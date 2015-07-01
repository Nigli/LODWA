<?php
require '../config.php';
use sender\SenderInfoDAO,utils\Validate,utils\Session;

$valid = Validate::admin($_POST);
$sender = $valid?SenderInfoDAO::editSenderInfo($valid):false;
$sender?Session::set("profile", "sent"):Session::set("profile", "notsent");
redirect_to("profile");