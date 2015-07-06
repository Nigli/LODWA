<script src="js/futures.js" type="text/javascript"></script>
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
            <button id="notice-confirm" type="submit" name="futures-submit" form="futures_form">Confirm</button>          
        </div>
    </div>
</div>
<!--END NOTICE POPUP-->
<div id="strategy_list_form" class="edit">
    <div id="top">
        <h2>Future Contracts</h2>
        <span id="rightspan">To edit future click on the table row</span><br>
    </div>
    <!--FUTURES FORM-->
    <form id="futures_form" method="post" action="processfut">
        <div id="left"> 
            <input id="future_note" type="hidden" value="<?php echo $notice_future ?>"/>
            <input id="id_futures" type="hidden" name="id_futures" value=""/>
            <label for="futures_name">Futures Name and Number of Decimal Places</label><br>
            <input id="futures_name" name="futures_name" type="text" value="" required=""/>        
            <input id="futures_dec" name="futures_dec" type="number" required=""/><br>
        </div>
        <div id="right">            
            <label for="futures_desc">Write Description for Futures Contract</label><br>
            <textarea id="futures_desc" name="futures_desc" required=""></textarea><br>
        </div>
        <div id="bottom"> 
            <div id="bottom-left">            
                <button id="reset" class="reset" type="reset" value="reset">Clear</button>
                <button id="delete" class="delete" type="button" value="delete" onclick="getValFutur(this)">Delete</button>
                <button id="update" class="update" type="button" value="update" onclick="getValFutur(this)">Update</button>
                <button id="new" type="button" value="new" onclick="getValFutur(this)">New</button>
            </div>           
        </div>
    </form>    
    <!--END FORM-->
    <span id="to_bottom"><i class="fa fa-chevron-down"></i></span>
</div>
<script>         
    function getValFutur(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        action = obj.value;
    }
</script>