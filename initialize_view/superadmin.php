<?php
use user\UserDAO,utils\Pagination;

$count = UserDao::CountUsers();
$links = isset($_GET)?$_GET:"";
$pagin = new Pagination($links,$count);
$users = UserDAO::GetUsers();
$status = UserDAO::GetStatus();