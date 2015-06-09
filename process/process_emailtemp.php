<?php
require '../config.php';
use utils\Validate,email\EmailTempDAO;
print_r($_POST);

$valid = Validate::emailtemp($_POST);
EmailTempDAO::UpdateEmailTemp($valid);

//function nl2p($text) {
//    return "<p>" . str_replace("\n", "</p><p>", $text) . "</p>";
//}
//$sap = nl2p($_POST['disclosure']);
//echo $sap;
//
//function p2nl($text){
//    return strip_tags($text);
//}
//$bezp = p2nl($sap);
//echo $bezp;