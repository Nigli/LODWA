<?php
require '../config.php';
use utils\Validate;

$valid = Validate::login($_POST);