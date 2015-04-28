<?php
    require 'config.php';
    $lastTR= new TradeRec(TradeRecDAO::GetLastTradeRec());
    $futuresContr=FuturesContractDAO::GetFutures();
    print_r($lastTR);
    echo $lastTR->fk_future;
?>
<form method="post" action="process.php">
    <select name="fk_future">
        <option selected="" value="<?php echo $lastTR->fk_future?>"><?php echo $lastTR->futures_name?></option>
        <option></option>
        <?php        
            foreach ($futuresContr as $key => $value) {
            echo "<option value='{$value->id_futures}'>{$value->futures_name}</option>";
        }
        ?>
    </select>
    <br>
    <select name="month">
        <option selected="" value="<?php echo $lastTR->month?>"><?php echo $lastTR->month?></option>
        <option></option>
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
    <select name="year">
        <option selected="" value="<?php echo $lastTR->year?>"><?php echo $lastTR->year?></option>
        <option></option>
        <option value="<?php echo date("Y")?>"><?php echo date("Y")?></option>
        <option value="<?php echo date("Y")+1?>"><?php echo date("Y")+1?></option>
        <option value="<?php echo date("Y")+2?>"><?php echo date("Y")+2?></option>
        <option value="<?php echo date("Y")+3?>"><?php echo date("Y")+3?></option>
        <option value="<?php echo date("Y")+4?>"><?php echo date("Y")+4?></option>
    </select>
    <br>
    <select name="entry_choice">
        <option selected="" value="<?php echo $lastTR->entry_choice?>"><?php echo $lastTR->entry_choice?></option>
        <option></option>
        <option value="BUY">BUY</option>
        <option value="SELL">SELL</option>
    </select>
    <br>
    <input name="tr_strategy" type="text" value="<?php echo $lastTR->tr_strategy?>"/><!--SHOULD BE HIDDEN-->
    <input name="num_contr" type="text" value="<?php echo $lastTR->num_contr?>"/>
    <input name="entry_price" type="text" value="<?php echo $lastTR->entry_price?>"/>
    <input name="price_target" type="text" value="<?php echo $lastTR->price_target?>"/>
    <input name="stop_loss" type="text" value="<?php echo $lastTR->stop_loss?>"/>
    <br>
    <input type="submit" value="Send" name="submit"/>
</form>