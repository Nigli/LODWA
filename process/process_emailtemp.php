<?php
require '../config.php';
use utils\Validate,email\EmailTempDAO,utils\Session;

$valid = Validate::emailtemp($_POST);
$emailtemp = $valid?EmailTempDAO::UpdateEmailTemp($valid):false;
$emailtemp?Session::set("emailtemp", "sent"):Session::set("emailtemp", "notsent");
redirect_to("emailtemp");