<?php
require 'config.php';
use traderec\TradeRec,traderec\TradeRecDAO, utils\Validate;
function trim_value(&$value){
    $value = trim($value);
    $value = str_replace("-","",$value);
    $value = str_replace("+","",$value);
    $value = str_replace("=","",$value);
}
echo"POST pre<pre>";
print_r($_POST);
echo "</pre>";

array_filter($_POST, 'trim_value'); 
echo"POST posle<pre>";
print_r($_POST);
echo "</pre>";