<?php
require '../config.php';
use utils\Validate,email\EmailTempDAO,utils\Session;

$valid = Validate::emailTemp($_POST);
$emailtemp = $valid?EmailTempDAO::updateEmailTemp($valid):false;
$emailtemp?Session::set("emailtemp", "sent"):Session::set("emailtemp", "notsent");
redirect_to("emailtemp");