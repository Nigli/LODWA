<?php
require 'config.php';
use receiver\ReceiverDao;
$rec = ReceiverDao::GetClientsReceivers();
var_dump($rec);
