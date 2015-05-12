<?php
namespace utils;
class Validate {
    /*
     * @function trim_replace 
     * trimming array  and replacing '-','+','=' with '' $_POST fields values from form   
     * before calling next function filter_var_array
     */
    public static function trim_replace(&$value){
        $value = trim($value);
        $value = str_replace("-","",$value);
        $value = str_replace("+","",$value);
        $value = str_replace("=","",$value);
    }    
    /*
     * @function validForm
     * in this function called array_filter function
     * set arguments for validating and sanitizing $_POST fields values from form
     * checking $_POST fields values type
     */
    public static function validForm($form) {
        array_filter($form, array('self', 'trim_replace'));
        $args = array(
            'fk_tr_type'    => array('filter'=> FILTER_VALIDATE_INT,   'options'=> array('min_range' => 1)),
            'fk_future'     => array('filter'=> FILTER_VALIDATE_INT,   'options'=> array('min_range' => 1)),
            'month'         => FILTER_SANITIZE_STRING,
            'year'          => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => date('Y'), 'max_range' => date('Y')+5)),
            'entry_choice'  => FILTER_SANITIZE_STRING,
            'num_contr'     => array('filter'=> FILTER_VALIDATE_INT,    'options'=> array('min_range' => 1)),
            'entry_price'   => array('filter'=> FILTER_SANITIZE_NUMBER_FLOAT,   'flags'=> FILTER_FLAG_ALLOW_FRACTION ),
            'price_target'  => array('filter'=> FILTER_SANITIZE_NUMBER_FLOAT,   'flags'=> FILTER_FLAG_ALLOW_FRACTION),
            'stop_loss'     => array('filter'=> FILTER_SANITIZE_NUMBER_FLOAT,   'flags'=> FILTER_FLAG_ALLOW_FRACTION)
        );                
        //checking type
        if(is_numeric($form['fk_tr_type'])&&is_numeric($form['fk_future'])&&is_numeric($form['year'])&&is_numeric($form['num_contr'])//if nummeric
        &&(is_string($form['month'])&&is_string($form['entry_choice']))){//if string
            $valid = filter_var_array($form,$args);
            if(!in_array(NULL || FALSE,$valid)){//if array field not empty or false
                echo "sve ok";
                return $valid;
            }else {
                echo "NIJE PROSAO VALID FILTER DRUGI USLOV<BR>";
                print_r($valid);
            }            
        } else{
            echo "NIJE NUMERIC ILI STRING PRVI USLOV<BR>";
        }
    }
}
