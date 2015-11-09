<?php $this->user_status == \utils\Enum::MANAGER_LEV1 || $this->user_status == \utils\Enum::MANAGER_LEV2 ? include $this->trresult_form : ""; ?>
<div id="tr_list">
    <h2>Trade Recommendations</h2> 
    <!--filter tr list-->
    <form id="tr_list_filter" method="get">
        <input type="hidden" value="1" name="page"/>
        <div class="filter">
            <label for="filter_entry_choice">By Entry Choice</label><br>
            <select id="filter_entry_choice" name="entry_choice">
                <option value="0">ALL</option>
                <option>BUY</option>
                <option>SELL</option>
            </select>
        </div>
        <div class="filter">
            <label for="filter_future">By Future Contract</label><br>
            <select id="filter_future" name='fk_future'>
                <option value="0">ALL</option>
                <?php
                if ($this->futures) {
                    foreach ($this->futures as $key => $future) {
                        ?>
                        <option value='<?php echo $future->id_futures ?>' ><?php echo $future->futures_name ?></option>
                        <?php
                    }
                } else {
                    //Session:set("err","trlisterror");
                }
                ?>
            </select>
        </div>
        <div class="filter">
            <label for="filter_result">By Result</label><br>
            <select id="filter_result" name="result">
                <option value="0">ANY</option>
                <option>TGTH</option>
                <option>STPH</option>
                <option>UNEX</option>
                <option>SCXL</option>
                <option>REPL</option>
                <option>TEST</option>
            </select>
        </div>
        <div class="filter">
            <label for="filter_strategy">By Strategy</label><br>
            <select id="filter_strategy" name="strategy">
                <option value="0">ANY</option>
                <?php
                if ($this->strategies) {
                    foreach ($this->strategies as $key => $strategy) {
                        ?>
                        <option value='<?php echo $strategy->id_strategy ?>' ><?php echo $strategy->strategy_name ?></option>
                        <?php
                    }
                } else {
                    //Session:set("err","trlisterror");
                }
                ?>
            </select>
        </div>
        <div id="bottom">
            <div id="bottom-left">
                <button form="tr_list_filter" class="reset" value="reset">Reset</button>
                <button form="tr_list_filter" type="submit">OK</button>
            </div>
        </div>
    </form>
    <!--end filter tr list-->
    <!--tr list-->
    <table>
        <thead>
            <tr>
                <th colspan="2">ID</th>
                <th>Contract</th>                
                <th>Strat</th>
                <th>Choice</th>
                <th>Entry Price</th>
                <th>Price Target</th>
                <th>Stop Loss</th>
                <th>Result</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <?php
        if ($this->lastTR) {
            foreach ($this->lastTR as $k => $tr) {
//                $this->listnumb++;
                ?>
                <tr>
                    <td data-title='TR Id' data-index="id_tr" ><?php echo $tr->id_tr ?></td>
                    <td data-title='Futures Name' data-index="futures_name"><?php echo $tr->futures_name ?></td>                    
                    <td data-title='Strat' data-index="strat_symbol"><?php echo $tr->strategy_symbol ?></td>
                    <td data-title='Choice' data-index="entry_choice"><?php echo $tr->entry_choice ?></td>
                    <td data-title='Entry Price' data-index="entry_price"><?php echo $tr->entry_price ?></td>
                    <td data-title='Price Target' data-index="price_target"><?php echo $tr->price_target ?></td>
                    <td data-title='Stop Loss' data-index="stop_loss"><?php echo $tr->stop_loss ?></td>                    
                    <td data-title='Result' data-index="result"><?php echo $tr->result != ""? $tr->result : "/" ?></td>
                    <td data-title='Date'><?php echo $tr->date ?></td>
                    <td data-title='Time'><?php echo $tr->time ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <!--IF NOTHING IN DB-->
            <tr><td>No Trade Recommendations in Database</td></tr>
            <?php
        }
        ?>        
    </table>
    <?php
    /*     * PAGINATION* */
    if ($this->pagin) {
        echo $this->pagin->createLinks($this->links);
    } 
    ?>
    <!--end tr list-->
</div>
<script>
    $("#filter_entry_choice").val("<?php echo $this->links['entry_choice'] ?>");
    $("#filter_future").val("<?php echo $this->links['fk_future'] ?>");    
    $("#filter_result").val("<?php echo $this->links['result'] ?>");  
    $("#filter_strategy").val("<?php echo $this->links['strategy'] ?>");
</script>