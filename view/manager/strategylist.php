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
            <label for="strategy_name">Strategy Name</label><br>
            <input id="strategy_name" name="strategy_name" type="text" value="" required=""/>
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