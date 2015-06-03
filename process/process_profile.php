<?php
require '../config.php';
use sender\SenderInfoDAO,utils\Validate;
$valid = Validate::admin($_POST);
SenderInfoDAO::EditSenderInfo($valid);
