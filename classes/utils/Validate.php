<?php

namespace utils;

use user\UserDAO,
    traderec\TradeRec,
    utils\Enum;

class Validate {

    private static function filter(&$value) {
        if (is_array($value)) {
            foreach ($value as $v) {
                $val = trim($v);
                $val = str_replace("--", "", $v);
                $val = str_replace("=", "", $v);
                $val = strip_tags($v);
                $val = htmlspecialchars($v, ENT_QUOTES);
                return $val;
            }
        } else {
            $value = trim($value);
            $value = str_replace("--", "", $value);
            $value = str_replace("=", "", $value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value, ENT_QUOTES);
        }
    }

    private static function checkToken($form, $field) {
        if (isset($form[$field]) && $form[$field] === Session::get($field)) {/*         * COMPARES TOKEN FROM FORM WITH TOKEN FORM SESSION* */
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private static function checkReferer($referer) {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $referer) {/*         * COMPARES SERVER REFERER WITH REFERER FROM CONFIG* */
            return TRUE;
        }
    }

    private static function checkPassHash($pass, $hash) {
        if (password_verify($pass, $hash)) {/*         * COMPARES PASSWORD FROM FORM WITH HASH FROM DB* */
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private static function trPrice($form) {
        if ($form['entry_choice'] === "BUY") {
            if ($form['price_target'] > $form['stop_loss']) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if ($form['stop_loss'] > $form['price_target']) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        return FALSE;
    }

    static function checkUser($valid) {
        $user = UserDAO::getUserByEmail($valid['email']); /*         * GET USER OBJECT BY EMAIL* */
        $pass = $user ? Validate::checkPassHash($valid['pass'], $user->user_pass) : FALSE; /*         * CHECKS USER PASSHASH* */
        return $pass ? $user : FALSE;
    }

    static function tr($form) {
        $args = array(/*             * CHECKS EACH TR FORM FIELD* */
            'fk_tr_type' => array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => 1)),
            'fk_future' => array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => 1)),
            'fk_strategy' => array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => 1)),
            'month' => FILTER_SANITIZE_STRING,
            'year' => array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => date('Y'), 'max_range' => date('Y') + 10)),
            'entry_choice' => FILTER_SANITIZE_STRING,
            'rpl_price' => FILTER_SANITIZE_STRING,
            'duration' => FILTER_SANITIZE_STRING,
            'num_contr' => array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => 1)),
            'entry_price' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION, 'options' => array('decimal' => '.')),
            'price_target' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION, 'options' => array('decimal' => '.')),
            'stop_loss' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION, 'options' => array('decimal' => '.'))
        );
        if (Validate::checkToken($form, "tr_token") && Validate::checkReferer(Enum::TR_REFERER) && Validate::trPrice($form)) {/*         * CHECKS TOKEN, REFERER AND PRICE* */
            array_filter($form, array('self', 'filter'));
            $valid = filter_var_array($form, $args);
            /*             * CHECK IF FIELD NOT EMPTY OR FALSE, MONTH AND ENTRY_CHOICE ARE VALID* */
            if (in_array($valid['month'], cal_info(0)['months']) && in_array($valid['entry_choice'], array('BUY', 'SELL')) && in_array($valid['duration'], array('DAY', 'GTC'))) {
                return $valid;
            } else {
                $e = "Validation field is empty or falce";
                TradeRec::logTRerrors($e);
            }
        } else {
            $e = "Validation - No Referer or token";
            TradeRec::logTRerrors($e);
        }
    }

    static function login($form) {

        if (Validate::checkToken($form, "login_token") && Validate::checkReferer(Enum::LOG_REFERER)) {/*         * CHECKS TOKEN AND REFERER* */
            array_filter($form, array('self', 'filter')); /*             * VALIDATE FIELDS* */
            $email = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
            $valid = array('email' => $email, 'pass' => $form['pass']);

            if (!in_array(NULL || FALSE, $valid)) {/*             * CHECK IF $VALID FIELDS NOT EMPTY OR FALSE* */
                return $valid;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    static function manager($form) {
        array_filter($form, array('self', 'filter'));
        if (isset($form['email'])) {
            $email = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
            $form['email'] = $email;
        }
        $valid = $form;
        return $valid;
    }

    static function user($form) {
        array_filter($form, array('self', 'filter'));
        $email = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
        $form['email'] = $email;
        $valid = $form;
        if (!in_array(NULL || FALSE, $valid)) {//CHECK IF $VALID FIELD NOT EMPTY OR FALSE
            return $valid;
        } elseif (isset($valid['id_user']) && $valid['id_user'] == '') {
            return $valid;
        } else {
            return FALSE;
        }
    }

    static function unsub($form) {
        array_filter($form, array('self', 'filter'));
        $valid = $form;
        if (!in_array(NULL || FALSE, $valid)) {//CHECK IF $VALID FIELD NOT EMPTY OR FALSE
            return $valid;
        } else {
            return FALSE;
        }
    }

    static function emailTemp($form) {
        $form['disclosure'] = strip_tags($form['disclosure']);
        $valid = $form;
        if (!in_array(NULL || FALSE, $valid)) {//CHECK IF $VALID FIELD NOT EMPTY OR FALSE
            return $valid;
        } else {
            return FALSE;
        }
    }

}
