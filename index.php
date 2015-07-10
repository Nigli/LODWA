<?php

require 'config.php';

$controller_name = isset($_GET['p']) ? ucfirst("controller\\" . $_GET['p'] . "Controller") : "controller\LoginController";
$controller = new $controller_name;
isset($_GET['process']) ? $controller->process($_POST) : $controller->view();
