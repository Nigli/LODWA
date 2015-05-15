<?php
namespace utils;
class Validate {
    /*
     * @function trim_replace 
     * trimming $_POST fields values from form   
     * before calling next function filter_var_array
     */
    static function trim(&$value){
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
    static function tr($form) {
        $args = array(
            'fk_tr_type'    => array('filter'=> FILTER_VALIDATE_INT,   'options'=> array('min_range' => 1)),
            'fk_future'     => array('filter'=> FILTER_VALIDATE_INT,   'options'=> array('min_range' => 1)),
            'month'         => FILTER_SANITIZE_STRING,
            'year'          => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => date('Y'), 'max_range' => date('Y')+5)),
            'entry_choice'  => FILTER_SANITIZE_STRING,
            'num_contr'     => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => 1)),
            'entry_price'   => array('filter'=> FILTER_VALIDATE_FLOAT,  'options'=> array('decimal'=>'.') ),
            'price_target'  => array('filter'=> FILTER_VALIDATE_FLOAT,   'options'=> array('decimal'=>'.') ),
            'stop_loss'     => array('filter'=> FILTER_VALIDATE_FLOAT,   'options'=> array('decimal'=>'.') )
        );
        if(Validate::checkToken($form,"tr_token")&&Validate::checkReferer(TR_REFERER)){////IF THERE IS A TOKEN AND A REFERER
            array_filter($form, array('self', 'trim'));
            $valid = filter_var_array($form,$args);
            if(!in_array(NULL || FALSE,$valid)&&in_array($valid['month'],cal_info(0)['months'])&&in_array($valid['entry_choice'],array('BUY','SELL'))){//CHECK IF $VALID FIELD NOT EMPTY OR FALSE, MONTH AND ENTRY_CHOICE ARE VALID
                echo "sve ok";//WITHOUT MESSAGE
                return $valid;
            }else {
                echo "NIJE PROSAO POLJE JE EMPTY ILI FALSE ILI MESEC ILI ENTRY CHOICE NE VALJA<BR>";//ERROR LOG
            }
        }else {
            echo "NIJE PROSAO NEMA REFERERA ILI LOS TOKEN";//ERROR LOG
        }
    }
}
