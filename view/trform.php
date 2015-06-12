<script src="js/tr.js" type="text/javascript"></script>
<div id="spinner"></div>
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h4></h4>
        </div>
    </div>
    <span id="notice-span"></span>
    <div id="bottom">
        <div id="bottom-left">            
            <button id="notice-close" type="button" name="close">Close</button>
            <button id="notice-cancel" type="button" name="cancel">Cancel</button>
            <button id="notice-confirm" type="submit" name="fk_tr_type" form="tr_form">Confirm</button>
        </div>
    </div>
</div>
<form id="tr_form" method="post" action="processtr">
    <input type="hidden" name="tr_token" value="<?php echo $tr_token ?>"/>
    <div id="top">
        <h2>New Trade Rec</h2>    
        <span id="rightspan"><?php include "process/strategy_name.php" ?></span><br>
    </div>
    <div id="left">
        <!--***-->
        <!--ENTRY CHOICE SELECT-->
        <label for="tr_form_entry_choice">Entry Choice and duration</label><br>
        <select id="tr_form_entry_choice" name="entry_choice">
            <option value="BUY">BUY</option>
            <option value="SELL">SELL</option>
        </select>
        <select id="tr_form_duration" name="duration">
            <option value="DAY">DAY</option>
            <option value="GTC">GTC</option>
        </select><br>
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
            for ($i = 0; $i < 10; $i++) {
                $year=date('Y')+$i; ?>
                <option value='<?php echo $year ?>'><?php echo $year ?></option>
            <?php                
            }
            ?>
        </select>
    </div>
    <!--***-->
    <!--PRICES INPUT-->
    <div id="right">
        <label for="tr_form_entry_price">Entry Price</label>
        <input id="tr_form_entry_price" name="entry_price" type="number" value="" required="" step="any" title="Enter number in a format xxxx.xx"/><br> 
        <label for="tr_form_stop_loss">Stop Loss</label>
        <input id="tr_form_stop_loss" name="stop_loss" type="number" value='' required="" step="any" title="Enter number in a format xxxx.xx"/><br>
        <label for="tr_form_price_target">Price Target</label>
        <input id="tr_form_price_target" name="price_target" type="number" value="" required="" step="any" title="Enter number in a format xxxx.xx"/>
    </div>
    <!--***-->
    <!--BUTTONS-->
    <div id="bottom">
        <div id="bottom-right">                
            <button id="tr_form_submit" type="button" value="1" name="fk_tr_type" onclick="getVal(this)">Trade</button>
        </div>
        <div id="bottom-left">
            <button id="tr_form_cxl" type="button" value="3" name="fk_tr_type" onclick="getVal(this)">STR CXL</button>
            <button id="tr_form_rpl" type="button" value="2" name="fk_tr_type" onclick='getVal(this)'>CXL and RPL</button>
        </div>            
    </div>
</form>
<!--***-->
<!--LAST 5 TR TABLE-->
<div id="tr_list_5">
    <h2>Last 5 Trade Recommendations</h2>    
    <table>
        <thead>
            <tr>
                <th></th>
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
                <td data-title='Duration' class="td_hidden"><?php echo $tr->duration ?></td>
                <td data-title='Strategy name' class="td_hidden"><?php echo $tr->strategy_name ?></td>
            </tr>
        <?php        
        }
        ?>
    </table>    
</div>
<script>       
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        tr_type = obj.innerHTML;
    }
    $("#tr_form_future").val("<?php echo $lastTR->fk_future ?>");
    $("#tr_form_month").val("<?php echo $lastTR->month ?>");
    $("#tr_form_year").val("<?php echo $lastTR->year ?>");
    $("#tr_form_entry_choice").val("<?php echo $lastTR->entry_choice ?>");
    $("#tr_form_duration").val("<?php echo $lastTR->duration ?>");
    $("#tr_form_entry_price").val("<?php echo $lastTR->entry_price ?>");
    $("#tr_form_price_target").val("<?php echo $lastTR->price_target ?>");    
    $("#tr_form_stop_loss").val("<?php echo $lastTR->stop_loss ?>");
    $("#tr_form_num_contr").val("<?php echo $lastTR->num_contr ?>");
</script>
