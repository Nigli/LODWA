<?php
require 'config.php';


$string = ucfirst("controller\\".$_GET['p']."Controller");
$controller = new $string;
$controller->view();