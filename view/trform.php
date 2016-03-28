<form id="tr_form" method="post" action="processtr">
    <input type="hidden" name="tr_token" value="<?php echo $this->token ?>"/>
    <input id="tr_note" type="hidden" value="<?php echo $this->notice ?>"/>
    <div id="top">
        <h2>New Trade Rec</h2>    
        <span id="rightspan"><?php //include "process/strategy_name.php" ?></span><br>
    </div>
    <div id="left">
        <!--ENTRY CHOICE SELECT-->
        <label>Entry Choice and duration</label><br>
        <select id="entry_choice" name="entry_choice">
            <option value="BUY">BUY</option>
            <option value="SELL">SELL</option>
        </select>
        <select id="duration" name="duration">
            <option value="DAY">DAY</option>
            <option value="GTC">GTC</option>
        </select><br>
        <!--END ENTRY CHOICE SELECT-->
        <!--FUTURE CONTRACT SELECT-->
        <label>Contract and number of contracts</label>
        <select id='fk_future' name='fk_future'>
            <?php
            foreach ($this->futures as $key => $value) {
                ?>
                <option value='<?php echo $value->id_futures ?>'><?php echo $value->futures_name ?></option>
                <?php
            }
            ?>
        </select>
        <input id="num_contr" class="disable" name="num_contr" type="number" value="" required="" min="1"/><br>
        <!--END FUTURE CONTRACT SELECT-->
        <!--MONTH AND YEAR SELECT-->
        <label>Month and Year</label><br>
        <select id="month" name="month">
            <?php
            $mon = cal_info(0)['months'];
            for ($i = 1; $i <= count($mon); $i++) {
                ?>
                <option value='<?php echo $mon[$i] ?>'><?php echo $mon[$i] ?></option>
                <?php
            }
            ?>
        </select>
        <select id="year" name="year">
            <?php
            for ($i = 0; $i < 10; $i++) {
                $year = date('Y') + $i;
                ?>
                <option value='<?php echo $year ?>'><?php echo $year ?></option>
                <?php
            }
            ?>
        </select>
        <!--END MONTH AND YEAR SELECT-->
    </div>
    <!--***-->
    <!--PRICES INPUT-->    
    <div id="right">
        <label>Entry Price</label>
        <input id="entry_price" class="prices" name="entry_price" type="number" value="" required=""/><br> 
        <label>Stop Loss</label><br>
        <input type="radio" name="rpl_price" value="stop_loss" class="radio_rep"/>
        <input id="stop_loss" class="prices disable" name="stop_loss" type="number" value='' required="" /><br>
        <label>Price Target</label><br>
        <input type="radio" name="rpl_price" value="price_target"  class="radio_rep"/>
        <input id="price_target" class="prices disable" name="price_target" type="number" value="" required="" />
    </div>
    <!--END PRICES INPUT-->
    <!--BUTTONS-->
    <div id="bottom">
        <div id="bottom-right">                
            <button id="tr_form_submit" type="button" value="1" name="fk_tr_type" onclick="getVal(this)">New Trade</button>
        </div>
        <div id="bottom-left">
            <button id="reset" class="reset" type="reset" name="receiver-submit" value="reset">Clear</button>
            <button id="tr_form_cxl" type="button" value="2" name="fk_tr_type" onclick="getVal(this)">STR CXL</button>
            <button id="tr_form_rpl" type="button" value="5" name="fk_tr_type" onclick="getVal(this)">CXL and RPL</button>
            <button id="tr_form_cancel" type="button">Cancel Trade</button>
        </div>            
    </div>
    <span id="to_bottom"><i class="fa fa-arrow-down"></i></span>
</form>
<!--***-->
<!--LAST 5 TR TABLE-->
<div id="tr_list_5">
    <h2>Last 5 Trade Recommendations</h2>    
    <table>
        <thead>
            <tr>
                <th colspan="2">ID</th>
                <th>Contract</th>
                <th>Strat</th>
                <th>Choice</th>
                <th>M&Y</th>
                <th>Qty</th>
                <th>Dur</th>
                <th>Entry Price</th>
                <th>Price Target</th>
                <th>Stop Loss</th>
                <th>Result</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <?php
        if ($this->last5TR) {
            foreach ($this->last5TR as $k => $tr) {
//                $this->index_numb++;
                ?>
                <tr>
                    <td data-title=''><?php echo $tr->tr_symbol ?></td>
                    <td data-title='Futures Name' data-index="futures_name"><?php echo $tr->futures_name ?></td>                   
                    <td data-title='Strat'><?php echo $tr->strategy_symbol ?></td>
                    <td data-title='Choice' data-index="entry_choice"><?php echo $tr->entry_choice ?></td>  
                    <td data-title='M&Y'><?php echo $tr->month." ".$tr->year ?></td>
                    <td data-title='Qty' data-index="num_contr"><?php echo $tr->num_contr ?></td>
                    <td data-title='Dur'><?php echo $tr->duration ?></td>
                    <td data-title='Entry Price' data-index="entry_price"><?php echo $tr->entry_price ?></td>
                    <td data-title='Price Target' data-index="price_target"><?php echo $tr->price_target ?></td>
                    <td data-title='Stop Loss' data-index="stop_loss"><?php echo $tr->stop_loss ?></td>                    
                    <td data-title='Result'><?php echo $tr->result != ""? $tr->result : "/" ?></td>
                    <td data-title='Date' data-index="date"><?php echo $tr->date ?></td>
                    <td data-title='Time' data-index="time"><?php echo $tr->time ?></td>
                    <td data-index="fk_future" class="td_hidden"><?php echo $tr->fk_future ?></td>
                    <td data-index="fk_strategy" class="td_hidden"><?php echo $tr->fk_strategy ?></td>
                    <td data-index="month" class="td_hidden"><?php echo $tr->month ?></td>
                    <td data-index="year" class="td_hidden"><?php echo $tr->year ?></td>            
                    <td data-index="duration" class="td_hidden"><?php echo $tr->duration ?></td>
                    <td data-index="strategy_name" class="td_hidden"><?php echo $tr->strategy_name ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td>No Trade Recommendations in Database</td></tr>
            <?php
        }
        ?>
    </table>    
</div><!--END LAST 5 TR TABLE-->
<script>
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        tr_type = obj.innerHTML;
    }
    $(document).ready(function(){
        $("#fk_future").val("<?php echo $this->lastTR->fk_future ?>");
        $("#month").val("<?php echo $this->lastTR->month ?>");
        $("#year").val("<?php echo $this->lastTR->year ?>");
        $("#entry_choice").val("<?php echo $this->lastTR->entry_choice ?>");
        $("#duration").val("<?php echo $this->lastTR->duration ?>");
        $("#entry_price").val("<?php echo $this->lastTR->entry_price ?>");
        $("#price_target").val("<?php echo $this->lastTR->price_target ?>");
        $("#stop_loss").val("<?php echo $this->lastTR->stop_loss ?>");
        $("#num_contr").val("<?php echo $this->lastTR->num_contr ?>");      
    });
</script>