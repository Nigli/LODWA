<?php
//defining application directorium
    define("APP_DIR",getenv("D:\Nikola\programiranje\php\wamp\www\LODWA"));
//class autoload
    function __autoload($classname){
        require_once(APP_DIR."classes/{$classname}.php");
    }
//redirection
    function redirect_to($new_location) {
        header("Location: " . $new_location);
    }