<?php

namespace utils;
class Enum {
    
    //user statuses constants
    const USER = 1;
    const MANAGER = 4;
    const ADMIN = 8;
    
    //sender server constants
    const SENDER_PASS = "ngna321";
    const SENDER_PORT = "25";
    const SENDER_HOST = "smtpout.secureserver.net";
    
    //referer constants
    const TR_REFERER = "http://localhost/LODWA/trade";
    const LOG_REFERER = "http://localhost/LODWA/";
//    const TR_REFERER = "http://192.168.0.101/LODWA/trade";
//    const LOG_REFERER = "http://192.168.0.101/LODWA/";
//    const TR_REFERER = "http://www.srlevel.com/trade";
//    const LOG_REFERER = "http://www.srlevel.com/";
    
    //time constants
    const CHICAGO_TIME = "America/Chicago";
    
}
