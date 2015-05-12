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
    /*
     * @function validForm
     * in this function called array_filter function
     * set arguments for validating and sanitizing $_POST fields values from form
     * checking $_POST fields values type
     */
    static function validForm($form) {
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
        if(isset($form['token'])&&$form['token']===Session::get('token')//IF THERE IS A TOKEN
        &&isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']=='http://localhost/LODWA/test_mail_form.php'){//IF THERE IS A REFERER (CHANGE PAGE)
            array_filter($form, array('self', 'trim'));
            $valid = filter_var_array($form,$args);
            if(!in_array(NULL || FALSE,$valid)){//CHECK IF $VALID FIELD NOT EMTY OR FALSE
                if(in_array($valid['month'],cal_info(0)['months'])&&in_array($valid['entry_choice'],array('BUY','SELL'))){//IF MONTH AND ENTRY_CHOICE ARE VALID
                    echo "sve ok";//WITHOUT MESSAGE
                    return $valid;            
                }else {
                    echo "NIJE PROSAO MESEC ILI ENTRY CHOICE<BR>";//ERROR LOG
                    return $valid;
                }
            }else {
                echo "NIJE PROSAO PRAZAN JE ILI FALSE<BR>";//ERROR LOG
                return $valid;
            }
        }else {
            echo "NIJE PROSAO NEMA REFERERA ILI LOS TOKEN";//ERROR LOG
        }
    }
}
