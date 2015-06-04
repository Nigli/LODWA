<?php
namespace utils;
use user\UserDAO;

class Validate {
    static function filter(&$value){        
        $value = str_replace("-","",$value);
        $value = str_replace("=","",$value);
        $value = htmlspecialchars($value);
        $value = stripslashes($value);
        $value = trim($value);
    }
    static function checkToken($form,$field) {
        if(isset($form[$field])&&$form[$field]===Session::get($field)){
           return TRUE;
        }
    }
    static function checkReferer($referer){
        if (isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']==$referer){
            return TRUE;
        }
    }
    static function checkPassHash($pass,$hash){
        if (password_verify($pass, $hash)) {
            return TRUE;
        }
    }
    static function tr($form) {
        $args = array(            
            'fk_tr_type'    => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => 1)),
            'fk_future'     => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => 1)),
            'month'         => FILTER_SANITIZE_STRING,
            'year'          => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => date('Y'), 'max_range' => date('Y')+10)),
            'entry_choice'  => FILTER_SANITIZE_STRING,
            'duration'      => FILTER_SANITIZE_STRING,
            'num_contr'     => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => 1)),
            'entry_price'   => array('filter'=> FILTER_SANITIZE_NUMBER_FLOAT,  'flags'  => FILTER_FLAG_ALLOW_FRACTION, 'options'=> array('decimal'=>'.') ),
            'price_target'  => array('filter'=> FILTER_SANITIZE_NUMBER_FLOAT,  'flags'  => FILTER_FLAG_ALLOW_FRACTION, 'options'=> array('decimal'=>'.') ),
            'stop_loss'     => array('filter'=> FILTER_SANITIZE_NUMBER_FLOAT,  'flags'  => FILTER_FLAG_ALLOW_FRACTION, 'options'=> array('decimal'=>'.') )
        );
        if(Validate::checkToken($form,"tr_token")&&Validate::checkReferer(TR_REFERER)){////IF THERE IS A TOKEN AND A REFERER 
            array_filter($form, array('self', 'filter'));
            $valid = filter_var_array($form,$args);
            if(!in_array(NULL || FALSE,$valid)&&in_array($valid['month'],cal_info(0)['months'])&&in_array($valid['entry_choice'],array('BUY','SELL'))&&in_array($valid['duration'],array('DAY','GTC'))){//CHECK IF $VALID FIELD NOT EMPTY OR FALSE, MONTH AND ENTRY_CHOICE ARE VALID
                return $valid;
            }else {
                echo "POLJE JE EMPTY ILI FALSE ILI MESEC ILI ENTRY CHOICE NE VALJA<BR>";//ERROR LOG
            }
        }else {
            echo "NEMA REFERERA ILI LOS TOKEN";//ERROR LOG
        }
    }
    static function login($form) {
        if(Validate::checkToken($form,"login_token")&&Validate::checkReferer(LOG_REFERER)){////IF THERE IS A TOKEN AND A REFERER
            array_filter($form, array('self', 'filter'));
            $email = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
            $pass = strlen($form['pass'])>=4?$form['pass']:NULL;
            $valid = array('email'=>$email,'pass'=>$pass);
            if(!in_array(NULL || FALSE,$valid)){//CHECK IF $VALID FIELD NOT EMPTY OR FALSE
                return $valid;
            }else {
                echo "POLJE JE EMPTY ILI FALSE<BR>";//ERROR LOG
            }
        }else {
            echo "NEMA REFERERA ILI LOS TOKEN";//ERROR LOG
        }
    }
    static function admin($form) {  
        array_filter($form, array('self', 'filter'));
        if(isset($form['email'])){
            $email = filter_var($form['email'], FILTER_VALIDATE_EMAIL);            
            $form['email'] = $email;
        }
        $valid = $form;
        if(!in_array(NULL || FALSE,$valid)){//CHECK IF $VALID FIELD NOT EMPTY OR FALSE
                return $valid;
        }elseif(isset($valid['id_futures'])&&$valid['id_futures']=='' || isset($valid['id_futures'])&&$valid['id_strategy']=='' || isset($valid['broker_acc'])&&$valid['broker_acc']=='0'|| isset($valid['id_receiver'])&&$valid['id_receiver']=='') {
                return $valid;
        }else {
            echo "POLJE JE EMPTY ILI FALSE";//ERROR LOG
        }
    }
}