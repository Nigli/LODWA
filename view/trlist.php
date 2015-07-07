<script src="inc/js/trlist.js" type="text/javascript"></script>
<!--TR LIST-->
<div id="tr_list">
    <h2>Trade Recommendations</h2> 
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
                if($this->futures){
                    foreach ($this->futures as $key => $future){
                    ?>
                    <option value='<?php echo $future->id_futures ?>' ><?php echo $future->futures_name ?></option>
                    <?php
                    }
                }
                else{
                    //Session:set("err","trlisterror");
                }
                ?>
            </select>
        </div>
        <div id="bottom">
            <div id="bottom-left">
                <button type="reset" class="reset">Reset</button>
                <button type="submit">OK</button>
            </div>
        </div>
    </form>
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
        if($this->lastTR){
            foreach ($this->lastTR as $k=>$tr){
                $this->listnumb++;?>
                <tr>
                    <td data-title=''><?php echo $this->listnumb ?></td>
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
    if($this->pagin){
        echo $this->pagin->createLinks($this->links);
    }else{
        //Session:set("err","trlisterror");
    }    
    ?>
</div>
<!--END TR LIST-->
<script>
    $("#filter_entry_choice").val("<?php echo $this->links['entry_choice'] ?>");
    $("#filter_future").val("<?php echo $this->links['fk_future'] ?>");
</script>