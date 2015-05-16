<?php
namespace utils;
use traderec\TradeRec,traderec\TradeRecDAO,futures\FuturesContractDAO,utils\Session,receiver\ReceiverDao;
class Render{
    public static function trform(){
        $tr_token=md5(uniqid(rand(),true));
        Session::set('tr_token', $tr_token);
        $lastTR = new TradeRec(TradeRecDAO::GetLastTradeRec());
        $futuresContr = FuturesContractDAO::GetFutures();
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
        
        $elements_in = array($tr_token,$future,$months,$years,$lastTR->tr_program,$lastTR->num_contr,$lastTR->entry_price,$lastTR->price_target,$lastTR->stop_loss,$lastTR->fk_future,$lastTR->month,$lastTR->year,$lastTR->entry_choice,);
        $elements_out = array('[TR_TOKEN]','[FUTURE_CONTRACTS]','[MONTHS]','[YEARS]','[TR_PROGRAM]','[TR_NUM_CONTR]','[TR_ENTRY_PRICE]','[TR_PRICE_TARGET]','[TR_STOP_LOSS]','[TR_FUTURE_CONTRACT]','[TR_MONTH]','[TR_YEAR]','[TR_ENTRY_CHOICE]');
        $form = str_replace($elements_out, $elements_in, file_get_contents('view/tr_form.html'));        
        $layout =file_get_contents("view/layout.html");
        echo str_replace('[CONTENT]', $form, $layout);
    }
    
    public static function trlist5(){
        $last5trs = TradeRecDAO::GetLast5TradeRecs();
        $listnumb = 0;
        $listtrs = "";
        foreach ($last5trs as $k=>$tr){
            $listnumb++;
            $listtrs .= "<tr>"
            ."<td data-title=''>".$listnumb
            ."</td><td data-title='Futures Name'>".$tr->futures_name
            ."</td><td data-title='Entry Choice'>".$tr->entry_choice
            ."</td><td data-title='Entry Price'>".$tr->entry_price
            ."</td><td data-title='Price Target'>".$tr->price_target
            ."</td><td data-title='Stop Loss'>".$tr->stop_loss
            ."</td><td data-title='Date'>".$tr->date
            ."</td><td data-title='Time'>".$tr->time
            ."</td></tr>";
        }
        $listtrs .= "";
        echo str_replace('[LIST]', $listtrs, file_get_contents('view/tr_list.html'));
        
    }
    public static function trlist(){
        $lasttrs = TradeRecDAO::GetTradeRecs();
        $listnumb = 0;
        $listtrs = "";
        foreach ($lasttrs as $k=>$tr){
            $listnumb++;
            $listtrs .= "<tr>"
            ."<td data-title=''>".$listnumb
            ."</td><td data-title='Futures Name'>".$tr->futures_name
            ."</td><td data-title='Entry Choice'>".$tr->entry_choice
            ."</td><td data-title='Entry Price'>".$tr->entry_price
            ."</td><td data-title='Price Target'>".$tr->price_target
            ."</td><td data-title='Stop Loss'>".$tr->stop_loss
            ."</td><td data-title='Date'>".$tr->date
            ."</td><td data-title='Time'>".$tr->time
            ."</td></tr>";
        }
        $listtrs .= "";
        $list = str_replace('[LIST]', $listtrs, file_get_contents('view/tr_list.html'));
        $layout =file_get_contents("view/layout.html");
        echo str_replace('[CONTENT]', $list, $layout);
    }
    public static function receiverlist(){
        $rec = ReceiverDao::GetActiveReceivers();        
        $listrec = "";
        foreach ($rec as $k=>$receiver) {
            $listrec .= "<tr>"
                ."<td data-title='Receiver Type'>".$receiver->receiver_type
                ."</td><td data-title='First Name'>".$receiver->first_name
                ."</td><td data-title='Last Name'>".$receiver->last_name
                ."</td><td data-title='Email'>".$receiver->email
                ."</td><td data-title='Date Added'>".date("d M Y", strtotime($receiver->date_added))
                ."</td><td data-title='NA Number'>".$receiver->na_number
                ."</td><td data-title='Broker Account'>".$receiver->broker_account
                ."</td><td data-title='Active'>".$receiver->active
                ."</td></tr>";                      
        }
        $listrec .= "";
        $list = str_replace('[LIST]', $listrec, file_get_contents('view/receivers_list.html'));
        $layout =file_get_contents("view/layout.html");
        echo str_replace('[CONTENT]', $list, $layout);
    }
}