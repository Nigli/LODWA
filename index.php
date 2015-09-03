<?php

require 'config.php';

$controller_name = isset($_GET['p']) ? "controller\\" . ucfirst($_GET['p'] . "Controller") : "controller\LoginController";
$controller = new $controller_name;
isset($_GET['process']) ? $controller->process($_POST) : $controller->view();
