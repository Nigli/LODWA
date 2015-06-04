<?php
namespace utils;
use utils\Session;
class Render{
    public static function View($get){        
        $user = Session::get('user_status');
        echo $user;
        if($user=="1"){
            Render::ViewUser($get);
        }elseif ($user=="3") {
            Render::ViewAdmin($get);
        }
        else{
            redirect_to("login");
        }
    }
    public static function ViewAdmin($get){        
        if(isset($get['p'])) {
            ob_start();
            require "initialize_view/{$get['p']}.php";
            include "view/{$get['p']}.php";
            $content = ob_get_clean();            
        }else {            
            ob_start();
            require "initialize_view/strategylist.php";
            include "view/strategylist.php";
            $content = ob_get_clean(); 
        }
        $layout=file_get_contents("view/layout_admin.html");
        echo str_replace('[CONTENT]', $content, $layout);
    }
     public static function ViewUser($get){        
        if(isset($get['p'])) {
            ob_start();
            require "initialize_view/{$get['p']}.php";
            include "view/{$get['p']}.php";
            $content = ob_get_clean();
        }else {            
            ob_start();
            require "initialize_view/trform.php";
            include "view/trform.php";
            $content = ob_get_clean(); 
        }
        $layout=file_get_contents("view/layout.html");
        echo str_replace('[CONTENT]', $content, $layout);
    }
}