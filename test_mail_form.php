<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<?php
    require 'config.php';
    use traderec\TradeRec,traderec\TradeRecDAO,futures\FuturesContractDAO;
    
    $lastTR= new TradeRec(TradeRecDAO::GetLastTradeRec());
    $futuresContr= FuturesContractDAO::GetFutures();
    
    
    echo "<pre>";
    print_r($lastTR);
    echo "</pre>";
    echo " <br>";
    echo "futures cont: <br>";
    echo "<pre>";
    print_r($futuresContr);
    echo "</pre>";
?>
<form method="post" action="process.php">
    <input type="hidden" name="fk_tr_type" value="1"/><!--Value based on choice-->
    <select id="form_future" name="fk_future">
        <?php        
            foreach ($futuresContr as $key => $value) {
            echo "<option value='{$value->id_futures}'>{$value->futures_name}</option>";
        }
        ?>
    </select>
    <br>
    <select id="form_month" name="month">
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>        
    </select>
    <br>
    <select id="form_year" name="year">
        <?php 
        for ($i = 0; $i < 5; $i++) {
            $year=date('Y')+$i;
            echo "<option value='{$year}'>{$year}</option>";
        }
        ?>
    </select>
    <br>
    <select id="form_entry_choice" name="entry_choice">
        <option value="BUY">BUY</option>
        <option value="SELL">SELL</option>
    </select>
    <br>
    <p><?php echo $lastTR->tr_strategy?></p><br>
    <p>Number of contracts</p>
    <input name="num_contr" type="text" value="<?php echo $lastTR->num_contr?>"/><br>
    <p>Entry Price</p>
    <input name="entry_price" type="text" value="<?php echo $lastTR->entry_price?>"/>
    <p>Price Target</p>
    <input name="price_target" type="text" value="<?php echo $lastTR->price_target?>"/>
    <p>Stop Loss</p>
    <input name="stop_loss" type="text" value="<?php echo $lastTR->stop_loss?>"/>
    <br>
    <input type="submit" value="Send" name="submit"/>
</form>

<script>    
    $("#form_future").val("<?php echo $lastTR->fk_future?>");
    $("#form_month").val("<?php echo $lastTR->month?>");
    $("#form_year").val("<?php echo $lastTR->year?>");
    $("#form_entry_choice").val("<?php echo $lastTR->entry_choice?>");
</script>