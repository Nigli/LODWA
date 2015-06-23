<?php
//class autoload
    function __autoload($classname){
        require_once(dirname(__FILE__)."/classes/".str_replace("\\", "/", $classname).".php");
    }
//redirection
    function redirect_to($new_location) {
        header("Location: " . $new_location);
    }
//referer constants
    define("TR_REFERER", "http://localhost/LODWA/trade");
    define("LOG_REFERER", "http://localhost/LODWA/login");
//    define("TR_REFERER", "http://192.168.0.101/LODWA/trade");
//    define("LOG_REFERER", "http://192.168.0.101/LODWA/login");
//    define("LOG_REFERER", "http://www.srlevel.com/login");
//    define("TR_REFERER", "http://www.srlevel.com/trade");
//    
//time constants
    define ("CHICAGO_TIME", "America/Chicago");