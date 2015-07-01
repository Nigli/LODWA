<script src="js/strategy.js" type="text/javascript"></script>
<div id="spinner"></div>
<!--NOTICE POPUP-->
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h3></h3>
        </div>
    </div>
    <span id="notice-span"></span>
    <div id="bottom">
        <div id="bottom-left">            
            <button id="notice-close" type="button" name="close">Close</button>
            <button id="notice-cancel" type="button" name="cancel">Cancel</button>
            <button id="notice-confirm-futures" type="submit" name="futures-submit" form="right">Confirm</button>            
            <button id="notice-confirm-strategy" type="submit" name="strategy-submit" form="left">Confirm</button>
        </div>
    </div>
</div>
<!--END NOTICE POPUP-->
<div id="strategy_list_form" class="edit">
    <div id="top">
        <h2>Edit or add New</h2>
        <span id="rightspan">To edit future or strategy click on the table row</span><br>
    </div>
    <!--STRATEGY FORM-->
    <form id="left" method="post" action="processstrat">
        <div class="strategy_form">
            <input id="strategy_note" type="hidden" value="<?php echo $notice_strategy ?>"/>
            <h3>Strategy</h3>
            <input id="id_strategy" type="hidden" name="id_strategy" value=""/>
            <label for="strategy_name">Strategy Name</label><br>
            <input id="strategy_name" name="strategy_name" type="text" value="" required=""/>
        </div>
        <div id="bottom-left">      
            <button form="left" id="reset-left" class="reset" type="reset" value="reset">Clear</button>
            <button form="left" id="delete-left" class="delete" type="button" value="delete" onclick="getValStrat(this)">Delete</button>  
            <button form="left" id="update-left" class="update" type="button" value="update" onclick="getValStrat(this)">Update</button>    
            <button form="left" id="new-left" type="button"  value="new" onclick="getValStrat(this)">New</button>
        </div>
    </form>
    <!--END STRATEGY FORM-->
    <!--FUTURES FORM-->
    <form id="right" method="post" action="processfut">
        <div class="futures_form">
            <h3>Futures</h3>    
            <input id="future_note" type="hidden" value="<?php echo $notice_future ?>"/>
            <input id="id_futures" type="hidden" name="id_futures" value=""/>
            <label for="futures_name">Futures Name and Number of Decimal Places</label><br>
            <input id="futures_name" name="futures_name" type="text" value="" required=""/>        
            <input id="futures_dec" name="futures_dec" type="number" required=""/><br>
            <label for="futures_desc">Write Description for Future</label><br>
            <textarea id="futures_desc" name="futures_desc" required=""></textarea><br>
            <label for="fk_strategy">Assign to Trading Strategy</label><br>
            <select id="fk_strategy" name="futures_prog"><?php foreach ($prog as $k=>$strategy){echo "<option value='".$strategy->id_strategy."'>".$strategy->strategy_name."</option>"; }?></select><br>        
        </div>
        <div id="bottom-right">            
            <button form="right" id="reset-right" class="reset" type="reset" value="reset">Clear</button>
            <button form="right" id="delete-right" class="delete" type="button" value="delete" onclick="getValFutur(this)">Delete</button>
            <button form="right" id="update-right" class="update" type="button" value="update" onclick="getValFutur(this)">Update</button>
            <button form="right" id="new-right" type="button" value="new" onclick="getValFutur(this)">New</button>
        </div>
    </form>    
    <!--END FORM-->
    <div id="bottom">                
    </div>
</div>
<script>         
    function getValStrat(obj) {
        document.getElementById("notice-confirm-strategy").value = obj.value;
        action = obj.value;
    }             
    function getValFutur(obj) {
        document.getElementById("notice-confirm-futures").value = obj.value;
        action = obj.value;
    }
</script>