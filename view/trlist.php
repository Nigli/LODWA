<script src="js/trlist.js" type="text/javascript"></script>
<!--NOTICE POPUP-->
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h3>Filter</h3>
        </div>
    </div>
    <span id="notice-span"></span>
    <form id="tr_list_filter" method="get" action="">
        <input type="hidden" value="1" name="page"/>
        <label for="list_form_entry_choice">By Entry Choice</label><br>
        <select id="list_form_entry_choice" name="entry_choice">
            <option value="ALL">ALL</option>
            <option>BUY</option>
            <option>SELL</option>
        </select><br>
        <label for="list_form_future">By Future Contract</label><br>
        <select id="list_form_future" name='fk_future'>
            <option value="0">ALL</option>
            <?php
            if($futuresContr){
                foreach ($futuresContr as $key => $value){
                ?>
                <option value='<?php echo $value->id_futures ?>' ><?php echo $value->futures_name ?></option>
                <?php
                }
            }
            else{
                //Session:set("err","trlisterror");
            }
            ?>
        </select>
    </form>
    <div id="bottom">
        <div id="bottom-left">
            <button id="notice-reset" class="reset" type="reset" value="reset">Reset</button>
            <button id="notice-cancel" type="button" name="cancel">Cancel</button>
            <button id="notice-confirm" type="submit" form="tr_list_filter">Confirm</button>
        </div>
    </div>
</div>
<!--END NOTICE POPUP-->
<!--TR LIST-->
<div id="tr_list">
    <h2>Trade Recommendations</h2> 
    <span id="filterspan">Filter</span>   
    <span id="filter_notice"></span>
    <table>
        <thead>
            <tr>
                <th colspan="2">#</th>
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
        if($lasttrs){
            foreach ($lasttrs as $k=>$tr){
                $listnumb++;?>
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
        }else{
            
        ?>
            <!--IF NOTHING IN DB-->
            <tr><td>No Trade Recommendations in Database</td></tr>
        <?php
        }
        ?>        
    </table>
    <?php 
        /**PAGINATION**/
    if($pagin){
        echo $pagin->createLinks($links);
    }else{
        //Session:set("err","trlisterror");
    }    
    ?>
</div>
<!--END TR LIST-->
<script>
    $("#list_form_entry_choice").val("<?php echo $links['entry_choice'] ?>");
    $("#list_form_future").val("<?php echo $links['fk_future'] ?>");
</script>