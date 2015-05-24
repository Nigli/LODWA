<?php
use traderec\TradeRecDAO,futures\FuturesContractDAO,utils\Session;
//CREATING TOKEN AND PUTTING IT TO SESSION
$tr_token=md5(uniqid(rand(),true));
Session::set('tr_token', $tr_token);
$futuresContr = FuturesContractDAO::GetFutures();//CREATIN FUTURES CONTRACT ARRAY WITH FUTURES CONTRACT OBJECTS
foreach ($futuresContr as $key => $future) {
    Session::set("cont".$future->id_futures,$future->tr_program_name);//PUTTING ID FUTURE AN PROGRAM NAME TO SESSION FOR DYNAMIC PROGRAM NAME ON FORM PAGE
}
$last5trs = TradeRecDAO::GetLast5TradeRecs();//CREATING LAST 5 TR ARRAY WITH TRADE RECOMMENDATION OBJECTS
$lastTR = $last5trs[0];//SELECTING LAST TR FROM $LAST5TRS
$listnumb = 0;
//var_dump($lastTR);
?>
<div id="tr_form">
    <form method="post" action="processtr">
        <input type="hidden" name="tr_token" value="<?php echo $tr_token ?>"/>
        <div id="tr_form-top">
            <h2>New Trade Rec</h2>    
            <span id="tr_form_program"><?php include "process/program_name.php" ?></span><br>
        </div>
        <div id="tr_form-left">
            <!--***-->
            <!--ENTRY CHOICE SELECT-->
            <label for="tr_form_entry_choice">Entry Choice</label>
            <select id="tr_form_entry_choice" name="entry_choice">
                <option value="BUY">BUY</option>
                <option value="SELL">SELL</option>
            </select>
            <!--***-->
            <!--FUTURE CONTRACT SELECT-->
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
            <input id="tr_form_num_contr" name="num_contr" type="number" value="" required="" min="1"/><br>
            <!--***-->
            <!--MONTH AND YEAR SELECT-->
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
        <!--***-->
        <!--PRICES INPUT-->
        <div id="tr_form-right">
            <label for="tr_form_entry_price">Entry Price</label>
            <input id="tr_form_entry_price" name="entry_price" type="number" value="" required="" step="any" title="Enter number in a format xxxx.xx"><br> 
            <label for="tr_form_price_target">Price Target</label>
            <input id="tr_form_price_target" name="price_target" type="number" value="" required="" step="any" title="Enter number in a format xxxx.xx"/><br> 
            <label for="tr_form_stop_loss">Stop Loss</label>
            <input id="tr_form_stop_loss" name="stop_loss" type="number" value='' required="" step="any" title="Enter number in a format xxxx.xx"/>
        </div>
        <!--***-->
        <!--BUTTONS-->
        <div id="tr_form-bottom">
            <div id="tr_form-bottom-left">
                <button id="tr_form_cxl" type="submit" value="3" name="fk_tr_type">STR CXL</button>
                <button id="tr_form_rpl" type="submit" value="2" name="fk_tr_type">CXL and RPL</button>
            </div>
            <div id="tr_form-bottom-right">                
                <button id="tr_form_submit" type="submit" value="1" name="fk_tr_type">Send</button>
            </div>
        </div>
    </form>
</div>
<!--***-->
<!--LAST 5 TR TABLE-->
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
                <td data-title='Id Futures' class="td_hidden"><?php echo $tr->fk_future ?></td>
                <td data-title='Month' class="td_hidden"><?php echo $tr->month ?></td>
                <td data-title='Year' class="td_hidden"><?php echo $tr->year ?></td>              
                <td data-title='Number of Contracts' class="td_hidden"><?php echo $tr->num_contr ?></td>
                <td data-title='Program name' class="td_hidden"><?php echo $tr->tr_program_name ?></td>
            </tr>
        <?php        
        }
        ?>
    </table>    
</div>
<script>    
    //    LOADING LAST TR TO FORM
    /**/
    $("#tr_form_future").val("<?php echo $lastTR->fk_future ?>");
    $("#tr_form_month").val("<?php echo $lastTR->month ?>");
    $("#tr_form_year").val("<?php echo $lastTR->year ?>");
    $("#tr_form_entry_choice").val("<?php echo $lastTR->entry_choice ?>");
    $("#tr_form_entry_price").val("<?php echo $lastTR->entry_price ?>");
    $("#tr_form_price_target").val("<?php echo $lastTR->price_target ?>");    
    $("#tr_form_stop_loss").val("<?php echo $lastTR->stop_loss ?>");
    $("#tr_form_num_contr").val("<?php echo $lastTR->num_contr ?>");
    /**/
    //    LOADING CLICKED TR TO FORM
    /**/
    $(document).ready(function () {
        $("tbody tr").on("click", function () {
            $tr_form = {tr_form_future:$(this).find("[data-title='Id Futures']").html(),
                        tr_form_entry_choice:$(this).find("[data-title='Entry Choice']").html(),
                        tr_form_entry_price:$(this).find("[data-title='Entry Price']").html(),
                        tr_form_price_target:$(this).find("[data-title='Price Target']").html(),
                        tr_form_stop_loss:$(this).find("[data-title='Stop Loss']").html(),
                        tr_form_num_contr:$(this).find("[data-title='Number of Contracts']").html(),
                        tr_form_month:$(this).find("[data-title='Month']").html(),
                        tr_form_year:$(this).find("[data-title='Year']").html(),
                        tr_form_program:$(this).find("[data-title='Program name']").html()
                    };
            $.each($tr_form, function(key, value){
                $("#"+key).val(value);
                $("#tr_form_program").html("Selected program: "+$tr_form.tr_form_program);
            });
            $(this).toggleClass("activetr");
        });
    });
    /**/
    //    LOADING PROGRAM NAME BASED ON SELECTED FUTURE CONTRACT SENDING VALUE WITH GET
    /**/
    $('#tr_form_future').on('change', function() {
        var value = $(this).val();
        $('#tr_form_program').load('process/program_name.php?f='+value);
    });
    /**/
</script>