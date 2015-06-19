<?php
namespace utils;
class Session {
    static function start(){
        if(!isset($_SESSION)){
                session_start();
        }
    }
    static function set($k,$v){
        self::start(); 
        $_SESSION[$k] = $v;
    }
    static function get($k,$d=null){
        self::start(); 
        return isset($_SESSION[$k])?$_SESSION[$k]:$d;
    }
    static function unsets($k){
        self::start(); 
        unset ($_SESSION[$k]);
    }
    static function destroy(){
        self::start();
        session_destroy();
    }
}