<?php
require '../config.php';
use utils\Validate,utils\Session;

$valid = Validate::login($_POST);/**VALIDATES LOGIN FIELDS**/
$user = $valid?Validate::checkUser($valid):false;/**CHECKS LOGIN VALIDATION**/

if($user){/**CHECKS USER VALIDATION AND SETS SESSIONS OF USER ID AND USER STATUS**/
    Session::set("user_id", $user->user_id);
    Session::set("user_status", $user->user_status);
    
    if($user->user_status==8){/**CHECKS USER STATUS AND REDIRECTS**/
        redirect_to("superadmin/1");/**SUPERADMIN**/
    }elseif($user->user_status==3) {
        redirect_to("strategylist");/**ADMIN**/
    }else {
        redirect_to("trade");/**USER**/
    }
}else {
    Session::set("err", "loginerror");/**IF LOGIN OR USER VALIDATION IS FALSE**/
    redirect_to("login");
}