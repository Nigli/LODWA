<?php
use user\UserDAO,utils\Pagination,utils\Session;

$notice = Session::get('admin');
Session::unsets('admin');

$count = UserDao::countUsers();
$links = isset($_GET)?$_GET:"";
$pagin = new Pagination($links,$count);
$users = UserDAO::getUsers();
$status = UserDAO::getStatus();
