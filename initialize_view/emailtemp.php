<?php
use email\EmailTempDAO,utils\Session;

$notice = Session::get('emailtemp');
Session::unsets('emailtemp');

$emailtemp = EmailTempDAO::getEmailTemp();