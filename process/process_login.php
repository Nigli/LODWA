<?php
require '../config.php';
use utils\Validate,utils\Session, utils\Enum;

$valid = Validate::login($_POST);/**VALIDATES LOGIN FIELDS**/
$user = $valid?Validate::checkUser($valid):false;/**CHECKS LOGIN VALIDATION**/

if($user){/**CHECKS USER VALIDATION AND SETS SESSIONS OF USER ID AND USER STATUS**/
    Session::set("user_id", $user->user_id);
    Session::set("user_status", $user->user_status);
    
    if($user->user_status==Enum::ADMIN){/**CHECKS USER STATUS AND REDIRECTS**/
        redirect_to("admin/1");/**admin**/
    }elseif($user->user_status==Enum::MANAGER) {
        redirect_to("strategylist");/**manager**/
    }else {
        redirect_to("trade");/**USER**/
    }
}else {
    Session::set("notify", "loginerror");/**IF LOGIN OR USER VALIDATION IS FALSE**/
    redirect_to("./");
}