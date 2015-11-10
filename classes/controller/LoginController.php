<?php

namespace controller;

use utils\Validate,
    utils\Session,
    utils\Enum;

class LoginController extends MainController {

    public $layout_login;

    public function __construct() {
        parent::__construct();
        $this->layout_login = "view/login.php";
        $this->unsetNotice("notify");
    }

    public function process($post) {
        $valid  = Validate::login($post); /*         * VALIDATES LOGIN FIELDS* */
        $user   = $valid ? Validate::checkUser($valid) : false; /*         * CHECKS LOGIN VALIDATION* */
        $this->logUser($post, $user);
        if ($user) {/*         * CHECKS USER VALIDATION AND SETS SESSIONS OF USER ID AND USER STATUS* */
            Session::set("user_id", $user->user_id);
            Session::set("user_status", $user->user_status);

            if ($user->user_status == Enum::ADMIN) {/*             * CHECKS USER STATUS AND REDIRECTS* */
                redirect_to("admin/1"); /*                 * admin* */
            } elseif ($user->user_status == Enum::MANAGER_LEV1) {
                redirect_to("strategylist"); /*                 * manager level 1* */
            } elseif ($user->user_status == Enum::MANAGER_LEV2) {
                redirect_to("receiverlist"); /*                 * manager level 2* */
            } else {
                redirect_to("trade"); /*                 * USER* */
            }
        } else {
            Session::set("notify", "loginerror"); /*             * IF LOGIN OR USER VALIDATION IS FALSE* */
            redirect_to("./");
        }
    }

    public function logUser($post, $user) {
        $time       = date("Y-m-d H:i:s");
        $email      = $post['email'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $success    = $user ? "OK" : "ERROR";
        $log        = $success . "|" . $time . "|" . $email . "|" . $ip_address . "|" . "\n";
        file_put_contents("log/userlog.txt", $log, FILE_APPEND | LOCK_EX);
        return FALSE;
    }

}
