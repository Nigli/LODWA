<?php
use utils\Session;
require '../config.php';
$login_token=md5(uniqid(rand(),true));
Session::set('login_token', $login_token);
$error = Session::get('err');