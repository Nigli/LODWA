<?php
require '../config.php';
use utils\Session;

Session::destroy();
redirect_to('./');
