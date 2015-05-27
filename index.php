<?php
require 'config.php';
use utils\Render;
if(!isset($_GET['p'])) {
    Render::view('login');
}else {    
    Render::view($_GET['p']);
}