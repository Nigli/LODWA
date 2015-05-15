<?php
namespace utils;

class Render{
    public static function formRend($futuresContr,$lastTR,$tr_token){        
        $future = "";
        foreach ($futuresContr as $key => $value) {
            $future .= "<option value='{$value->id_futures}'>{$value->futures_name}</option>";
        }
        $future .= "">
                
        $months = "";
        $mon = cal_info(0)['months'];
        for($i=1;$i<=count($mon);$i++){
            $months .= "<option value='".$mon[$i]."'>".$mon[$i]."</option>";
        }
        $months .= "";
        
        $years = "";
        for ($i = 0; $i < 5; $i++) {
            $year=date('Y')+$i;
            $years .= "<option value='{$year}'>{$year}</option>";
        }
        $years .= "";
        
        $elements_in = array($tr_token,$future,$months,$years,$lastTR->tr_strategy,$lastTR->num_contr,$lastTR->entry_price,$lastTR->price_target,$lastTR->stop_loss,$lastTR->fk_future,$lastTR->month,$lastTR->year,$lastTR->entry_choice,);
        $elements_out = array('[TR_TOKEN]','[FUTURE_CONTRACTS]','[MONTHS]','[YEARS]','[TR_STRATEGY]','[TR_NUM_CONTR]','[TR_ENTRY_PRICE]','[TR_PRICE_TARGET]','[TR_STOP_LOSS]','[TR_FUTURE_CONTRACT]','[TR_MONTH]','[TR_YEAR]','[TR_ENTRY_CHOICE]');
        $form = file_get_contents('test_mail_form.html');
        return str_replace($elements_out, $elements_in, $form);
    }
    public static function trListRend($last5trs){
        $listnumb = 0;
        $list5trs = "";
        foreach ($last5trs as $k=>$tr){
            $listnumb++;
            $list5trs .= "<div class=tr_list_row><span class='tr_list_number'>".$listnumb
            ."</span><span class='tr_list_contract'>".$tr->futures_name
            ."</span><span class='tr_list_entry_choice'>".$tr->entry_choice
            ."</span><span class='tr_list_entry_price'>".$tr->entry_price
            ."</span><span class='tr_list_price_target'>".$tr->price_target
            ."</span><span class='tr_list_stop_loss'>".$tr->stop_loss
            ."</span><span class='tr_list_date'>".$tr->date
            ."</span><span class='tr_list_time'>".$tr->time
            ."</span></div>";
        }
        $list5trs .= "";
        $list = file_get_contents('test_tr_list.html');
        return str_replace('[LIST]', $list5trs, $list);
    }
}