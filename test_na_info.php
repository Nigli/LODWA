<?php
include 'config.php';

$na_info=new NaInfo(NaInfoDAO::GetNaInfo());

print_r($na_info);

