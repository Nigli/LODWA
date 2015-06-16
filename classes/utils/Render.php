<?php
namespace utils;
use utils\Session,user\User;
class Render{
    public static function View($get){
        $user = Session::get('user_status');
        $access = isset($get['p'])?User::pageAccess($user, $get['p']):"";
        if($user=="1"){
            Render::ViewUser($get,$access);
        }elseif ($user=="3") {
            Render::ViewAdmin($get,$access);
        }elseif($user=="8"){
             Render::ViewSuperAdmin($access);
        }
        else{
            redirect_to("login");
        }
    }
    public static function ViewAdmin($get, $access){
        if(isset($get['p'])&& $access) {
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
    public static function ViewSuperAdmin($access){
        if($access){
            ob_start();
            require "initialize_view/superadmin.php";
            include "view/superadmin.php";
            $content = ob_get_clean();         
            $layout=file_get_contents("view/layout_superadmin.html");
            echo str_replace('[CONTENT]', $content, $layout);
        }else{
            ob_start();
            require "initialize_view/superadmin.php";
            include "view/superadmin.php";
            $content = ob_get_clean();         
            $layout=file_get_contents("view/layout_superadmin.html");
            echo str_replace('[CONTENT]', $content, $layout);
        }
    }
    public static function ViewUser($get,$access){        
        if(isset($get['p'])&& $access) {
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
    public static function ViewUnsub($get){        
        if(isset($get['id'])) {
            ob_start();
            require "initialize_view/unsub.php";
            if($subscriber->fk_receiver_type=='1'){                
                include "view/unsub/unsub_prime.php";
            }else{         
                include "view/unsub/unsub_form.php";
            }
            $content = ob_get_clean();
        }else {            
            ob_start();
            require "initialize_view/unsub.php";
            include "view/unsub/unsub_confirm.html";
            $content = ob_get_clean();
        }
        $layout=file_get_contents("view/unsub/layout_unsub.html");
        echo str_replace('[CONTENT]', $content, $layout);
    }    
    public static function ViewTemp($email){
        ob_start();
        include '../view/block_breakdown.php';
        $block_breakdown = ob_get_clean();
        if($email->fk_tr_type != 1){
            $color_title = 'cxl_rpl';
            if($email->rpl_price == "stop_loss"){
                $color_stop_loss = 'cxl_rpl';
                $color_price_target = '';
            }else {
                $color_stop_loss = '';
                $color_price_target = 'cxl_rpl';                
            }
        }else {
            $color_title ='';
            $color_stop_loss = '';
            $color_price_target = '';
        }
        
        $elements_in = array($email->title,$color_title,$color_stop_loss,$color_price_target,$email->tr_type_name,$email->date,$email->time,$email->strategy_name,$email->month,$email->futures_name,$email->entry_choice,$email->op_entry_choice,$email->duration,$email->entry_price,$email->price_target,$email->stop_loss,$email->description,$email->disclosure,$email->sender_email,$email->company_website,$email->company_name,$email->sender_address,$email->hash_email,$block_breakdown);
        $elements_out = array('[TITLE]','[COLOR_TRADE_TITLE]','[COLOR_STOP_LOSS]','[COLOR_TARGET]','[TRADE_TYPE]','[DATE]','[TIME]','[STRATEGY]','[MONTH]','[FUTURE]','[ENTRY_CHOICE]','[OP_ENTRY_CHOICE]','[DURATION]','[ENTRY_PRICE]','[PRICE_TARGET]','[STOP_LOSS]','[DESCRIPTION]','[DISCLOSURE]','[SENDER_EMAIL]','[COMPANY_WEBSITE]','[COMPANY_NAME]','[ADDRESS]','[SUBS_ID]','[BLOCK_BREAKDOWN]');
        
        $broker_temp_view = file_get_contents('../emailtemplates/broker_temp.php');
        $broker_temp = str_replace($elements_out, $elements_in, $broker_temp_view);
        
        $client_temp_view = file_get_contents('../emailtemplates/client_temp.php');
        $client_temp = str_replace($elements_out, $elements_in, $client_temp_view);
        return $temps=array($broker_temp,$client_temp);
    }
}