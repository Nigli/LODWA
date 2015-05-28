<?php
require 'config.php';
use utils\Render,utils\Session;
$loged = Session::get('user_id');
if($loged && isset($_GET['p'])) {
    Render::view($_GET['p']);
}elseif($loged && !isset($_GET['p'])) {
    Render::view('trform');
}else {
    redirect_to("view/login.php");
}