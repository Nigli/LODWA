<?php
require 'config.php';
use utils\Render;
if(!isset($_GET['p']) || $_GET['p']=='trform') {
    Render::view('trform');
}else {    
    Render::view($_GET['p']);
}