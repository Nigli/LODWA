<?php
    require 'config.php';
    $lastTR=TradeRecDAO::GetLastTradeRec();
    $futuresCont=FuturesContractDAO::GetFutures();
    print_r($lastTR);
    echo $lastTR->fk_future;
?>
<form method="post" action="">
    <select name="future_cont">
        <option selected="" value="-1"><?php echo $lastTR->futures_name?></option>
        <option></option>
        <?php        
            foreach ($futuresCont as $key => $value) {
            echo "<option>{$value->futures_name}</option>";
        }  
        ?>
    </select>
    
    <select name="month">
        <option selected=""><?php echo $lastTR->month?></option>
        <option></option>
        <option value="jan">Jan</option>
        <option value="sep">Sep</option>
    </select>
    <br>
    <select name="year">
        <option selected=""><?php echo $lastTR->year?></option>
        <option></option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
    </select>
    <br>
    <select name="choice">
        <option selected=""><?php echo $lastTR->entry_choice?></option>
        <option></option>
        <option value="buy">BUY</option>
        <option value="sell">SELL</option>
    </select>
    <br>
    <input name="num_cont" type="text" value="<?php echo $lastTR->num_contr?>"/>
    <input name="entry_price" type="text" value="<?php echo $lastTR->entry_price?>"/>
    <input name="price_target" type="text" value="<?php echo $lastTR->price_target?>"/>
    <input name="stop_loss" type="text" value="<?php echo $lastTR->stop_loss?>"/>
    <br>
    <input type="submit" value="Send" name="submit"/>
</form>