<div id="strategy_list_form" class="edit">
    <div id="top">
        <h2>Strategies</h2>
        <span id="rightspan">To edit strategy click on the table row</span><br>
    </div>
    <!--strategy form-->
    <form id="strategy_form" method="post" action="processstrat">
        <div id="left" class="strategy_form">
            <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
            <input id="manage" type="hidden" value="strategy"/>
            <input id="id_strategy" type="hidden" name="id_strategy" value=""/>
            <div id="strategy_name_left">
                <label for="strategy_name">Strategy Name</label><br>
                <input id="strategy_name" name="strategy_name" type="text" placeholder="Strategy Name" value="" required=""/>
            </div>
            <div id="strategy_name_right">
                <label for="strategy_symbol">Symbol</label><br>
                <input id="strategy_symbol" name="strategy_symbol" type="text" placeholder="Symb" value="" required=""/>
            </div>
            <div id="tr_per_day">
                <label for="num_tr_day">Number of trades per day</label><br>
                <input id="num_tr_day_check" type="checkbox"/>
                <label for="num_tr_day_check">unlimited trades</label><br>
                <input id="num_tr_day" name="num_tr_day" type="text" placeholder="#TR's" value=""/><br>
            </div>
            <div id="tr_time">
                <div id="tr_time_left">
                    <label for="start_time">Trading starts at</label><br>
                    <input id="start_time_check" type="checkbox"/>
                    <label for="start_time_check">Any Time</label>
                    <input id="start_time" name="start_time" type="time" value=""/>
                </div>                
                <div id="tr_time_right">
                    <label for="end_time">Trading ends at</label><br>
                    <input id="end_time_check" type="checkbox"/>
                    <label for="end_time_check">Any Time</label>
                    <input id="end_time" name="end_time" type="time" value=""/>
                </div>               
            </div>
            <div id="cxr_time">
                <div id="cxr_time_left">
                    <label for="cxr_start_time">CXL and RPL starts at</label><br>
                    <input id="cxr_start_time_check" type="checkbox"/>
                    <label for="cxr_start_time_check">Any Time</label>
                    <input id="cxr_start_time" name="cxr_start_time" type="time" value=""/>
                </div>                
                <div id="cxr_time_right">
                    <label for="cxr_end_time">CXL and RPL ends at</label><br>
                    <input id="cxr_end_time_check" type="checkbox"/>
                    <label for="cxr_end_time_check">Any Time</label>
                    <input id="cxr_end_time" name="cxr_end_time" type="time" value=""/>
                </div>

            </div>
        </div>
        <div id="right">
            <label for="futures_form">Futures Contract (Contracts) *</label><br>
            <div id="futures_area">            
                <?php
                if ($this->futures) {
                    foreach ($this->futures as $k => $v) {
                        ?>
                        <div id='futures_check'>
                            <input name="futures_info[]" id="futures_id<?php echo $v->id_futures ?>" type="checkbox" value="<?php echo $v->id_futures ?>"/><label><?php echo $v->futures_name ?></label>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <span>No Future Contracts in database</span>
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="bottom">  
            <div id="bottom-left">      
                <button id="reset" class="reset" type="reset" value="reset">Clear</button>
                <button id="delete" class="delete" type="button" value="delete" onclick="getValStrat(this)">Delete</button>  
                <button id="update" class="update" type="button" value="update" onclick="getValStrat(this)">Update</button>    
                <button id="new" type="button"  value="new" onclick="getValStrat(this)">New</button>
            </div>         
        </div>
    </form>
    <!--END strategy form-->    
    <span id="to_bottom"><i class="fa fa-arrow-down"></i></span>
</div>
<script>
    function getValStrat(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        action = obj.value;
    }
</script>