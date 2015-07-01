<?php
use utils\Session;
require '../config.php';

$login_token=md5(uniqid(rand(),true));/**CREATES TOKEN AND PUTS IT IN A SESSION**/
Session::set('login_token', $login_token);

$error = Session::get('err'); /**GETS ERROR IF ERR IS SET**/