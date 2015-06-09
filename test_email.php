<?php
require 'config.php';
use receiver\ReceiverDao;

$rec=ReceiverDao::GetActiveReceivers();

foreach ($rec as $k=>$v){
    echo md5($v->email)."<br>";
}