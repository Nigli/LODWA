<?php
require 'config.php';
use utils\Render;

//var_dump($lasttrs);
//$cont =new Controler;
//$cont->loadView($_GET);
//echo Render::formRend($futuresContr,$lastTR,$tr_token);
if(!isset($_GET['p']) || $_GET['p']=='trform') {
    Render::trform();
    Render::trlist5();
}else {    
    Render::$_GET['p']();
}