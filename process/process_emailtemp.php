<?php
require '../config.php';
use utils\Validate,email\EmailTempDAO,utils\Session;

$valid = Validate::emailTemp($_POST);
$emailtemp = $valid?EmailTempDAO::updateEmailTemp($valid):false;
$emailtemp?Session::set("notify", "sent"):Session::set("notify", "notsent");
redirect_to("emailtemp");