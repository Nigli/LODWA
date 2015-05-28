<?php
require 'config.php';
use user\UserDAO;

echo password_hash("admin", PASSWORD_DEFAULT)."\n";



$user = UserDAO::GetUserByEmail("admin@admin.com");
var_dump($user);
