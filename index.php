<?php

require 'config.php';

$controller_name = isset($_GET['p']) ? ucfirst("controller\\" . $_GET['p'] . "Controller") : "controller\LoginController";
$controller = new $controller_name;
$controller->view();