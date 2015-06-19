<?php
use email\EmailTempDAO,utils\Session;
$emailtemp = EmailTempDAO::GetEmailTemp();
$notice = Session::get('emailtemp');
Session::unsets('emailtemp');

