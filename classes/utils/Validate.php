<?php
namespace utils;
class Validate {
    /*
     * @function trim_replace 
     * trimming $_POST fields values from form   
     * before calling next function filter_var_array
     */
    public static function trim(&$value){
        $value = trim($value);        
    }    
    /*
     * @function validForm
     * in this function called array_filter function
     * set arguments for validating and sanitizing $_POST fields values from form
     * checking $_POST fields values type
     */
    public static function validForm($form) {
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
        array_filter($form, array('self', 'trim'));
        $valid = filter_var_array($form,$args);
        if(!in_array(NULL || FALSE,$valid)){//if array field not empty or false 
            if(in_array($valid['month'],cal_info(0)['months'])&&in_array($valid['entry_choice'],array('BUY','SELL'))){
                echo "sve ok";//WITHOUT MESSAGE
                return $valid;            
            }else {
                echo "NIJE PROSAO MESEC ILI ENTRY CHOICE<BR>";
                return $valid;//ERROR LOG
            }
        }else {
            echo "NIJE PROSAO PRAZAN JE ILI FALSE<BR>";
            return $valid;//ERROR LOG
        }
    }
}
