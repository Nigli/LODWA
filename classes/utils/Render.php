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
            $color_title = 'color:red';
            if($email->rpl_price == "stop_loss"){
                $color_stop_loss = 'color:red;';
                $color_price_target = '';
            }elseif($email->rpl_price == "price_target") {
                $color_stop_loss = '';
                $color_price_target = 'color:red;';                
            }else {
                $color_stop_loss = '';
                $color_price_target = '';
            }
        }else {
            $color_title ='';
            $color_stop_loss = '';
            $color_price_target = '';
        }
        $elements = array (
            '[TITLE]'=>$email->title,
            '[COLOR_TRADE_TITLE]'=>$color_title,
            '[COLOR_STOP_LOSS]'=>$color_stop_loss,
            '[COLOR_TARGET]'=>$color_price_target,
            '[TRADE_TYPE]'=>$email->tr_type_name,
            '[DATE]'=>$email->date,
            '[TIME]'=>$email->time,
            '[STRATEGY]'=>$email->strategy_name,
            '[MONTH]'=>$email->month,
            '[FUTURE]'=>$email->futures_name,
            '[ENTRY_CHOICE]'=>$email->entry_choice,
            '[OP_ENTRY_CHOICE]'=>$email->op_entry_choice,
            '[DURATION]'=>$email->duration,
            '[ENTRY_PRICE]'=>$email->entry_price,
            '[PRICE_TARGET]'=>$email->price_target,
            '[STOP_LOSS]'=>$email->stop_loss,
            '[DESCRIPTION]'=>$email->description,
            '[DISCLOSURE]'=>$email->disclosure,
            '[SENDER_EMAIL]'=>$email->sender_email,
            '[COMPANY_WEBSITE]'=>$email->company_website,
            '[COMPANY_NAME]'=>$email->company_name,
            '[ADDRESS]'=>$email->sender_address,
            '[SUBS_ID]'=>$email->hash_email,
            '[BLOCK_BREAKDOWN]'=>$block_breakdown
        );
        $elements_in = array_values($elements);
        $elements_out = array_keys($elements);
        
        $broker_temp_view = file_get_contents('../emailtemplates/broker_temp.php');
        $broker_temp = str_replace($elements_out, $elements_in, $broker_temp_view);
        
        $client_temp_view = file_get_contents('../emailtemplates/client_temp.php');
        $client_temp = str_replace($elements_out, $elements_in, $client_temp_view);
        return $temps=array($broker_temp,$client_temp);
    }
}