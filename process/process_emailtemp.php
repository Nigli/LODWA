<?php
require '../config.php';
use utils\Validate,email\EmailTempDAO;

$valid = Validate::emailtemp($_POST);
EmailTempDAO::UpdateEmailTemp($valid);
redirect_to("emailtemp");