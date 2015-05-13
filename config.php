<?php
//class autoload
    function __autoload($classname){
        require_once(dirname(__FILE__)."/classes/".str_replace("\\", "/", $classname).".php");
    }
//redirection
    function redirect_to($new_location) {
        header("Location: " . $new_location);
    }
    define("TR_REFERER", "http://localhost/LODWA/test_mail_form.php");