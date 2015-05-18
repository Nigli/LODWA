<?php
use traderec\TradeRec,traderec\TradeRecDAO,futures\FuturesContractDAO,utils\Session;
$tr_token=md5(uniqid(rand(),true));
Session::set('tr_token', $tr_token);
$lastTR = new TradeRec(TradeRecDAO::GetLastTradeRec());
$futuresContr = FuturesContractDAO::GetFutures();
foreach ($futuresContr as $key => $future) {
    Session::set("cont".$future->id_futures,$future->tr_program_name);
}
$last5trs = TradeRecDAO::GetLast5TradeRecs();
$listnumb = 0;
?>
<div id="tr_form">
    <form method="post" action="process/process_tr.php">
        <input type="hidden" name="tr_token" value="<?php echo $tr_token ?>"/>
        <input type="hidden" name="fk_tr_type" value="1"/><!--Value based on choice TR,SCX OR CXR???-->
        <div id="tr_form-top">
            <h2>New Trade Rec</h2>    
            <span id="tr_form_program"><?php include "process/program_name.php" ?></span><br>
        </div>
        <div id="tr_form-left">
            <label for="tr_form_entry_choice">Entry Choice</label>
            <select id="tr_form_entry_choice" name="entry_choice">
                <option value="BUY">BUY</option>
                <option value="SELL">SELL</option>
            </select>
            <label for="tr_form_future">Contract and number of contracts</label>
            <select id='tr_form_future' name='fk_future'>
                <?php
                foreach ($futuresContr as $key => $value) { 
                ?>
                    <option value='<?php echo $value->id_futures ?>' ><?php echo $value->futures_name ?></option>
                <?php                
                }
                ?>
            </select>
            <input id="tr_form_num_contr" name="num_contr" type="number" value='<?php echo $lastTR->num_contr ?>'/><br> 
            <label for="tr_form_month">Month and Year</label><br>
            <select id="tr_form_month" name="month">
                <?php                 
                $mon = cal_info(0)['months'];
                for($i=1;$i<=count($mon);$i++){
                ?>
                    <option value='<?php echo $mon[$i] ?>'><?php echo $mon[$i] ?></option>
                <?php                
                }
                ?>
            </select>
            <select id="tr_form_year" name="year">
                <?php
                for ($i = 0; $i < 5; $i++) {
                    $year=date('Y')+$i; ?>
                    <option value='<?php echo $year ?>'><?php echo $year ?></option>
                <?php                
                }
                ?>
            </select>
        </div>
        <div id="tr_form-right">
            <label for="tr_form_entry_price">Entry Price</label>
            <input id="tr_form_entry_price" name="entry_price" type="text" value="<?php echo $lastTR->entry_price ?>"/><br> 
            <label for="tr_form_price_target">Price Target</label>
            <input id="tr_form_price_target" name="price_target" type="text" value="<?php echo $lastTR->price_target ?>"/><br> 
            <label for="tr_form_stop_loss">Stop Loss</label>
            <input id="tr_form_stop_loss" name="stop_loss" type="text" value="<?php echo $lastTR->stop_loss ?>"/>
        </div>
        <input id="tr_form_submit" type="submit" value="Send" name="submit"/>
    </form>
</div>
<div id="tr_list">
    <h2>Last 5 Trade Recommendations</h2>    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Contract</th>
                <th>Entry Choice</th>
                <th>Entry Price</th>
                <th>Price Target</th>
                <th>Stop Loss</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <?php        
        foreach ($last5trs as $k=>$tr){
            $listnumb++;
            ?>
            <tr>
                <td data-title=''><?php echo $listnumb ?></td>
                <td data-title='Futures Name'><?php echo $tr->futures_name ?></td>
                <td data-title='Entry Choice'><?php echo $tr->entry_choice ?></td>
                <td data-title='Entry Price'><?php echo $tr->entry_price ?></td>
                <td data-title='Price Target'><?php echo $tr->price_target ?></td>
                <td data-title='Stop Loss'><?php echo $tr->stop_loss ?></td>
                <td data-title='Date'><?php echo $tr->date ?></td>
                <td data-title='Time'><?php echo $tr->time ?></td>
            </tr>
        <?php        
        }
        ?>
    </table>    
</div>
<script>
    $('#tr_form_future').on('change', function() {
        var value = $(this).val();
        $('#tr_form_program').load('process/program_name.php?f='+value);
    });
    $("#tr_form_future").val("<?php echo $lastTR->fk_future ?>");
    $("#tr_form_month").val("<?php echo $lastTR->month ?>");
    $("#tr_form_year").val("<?php echo $lastTR->year ?>");
    $("#tr_form_entry_choice").val("<?php echo $lastTR->entry_choice ?>");
</script>
