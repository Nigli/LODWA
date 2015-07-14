<div id="futures_list_form" class="edit">
    <div id="top">
        <h2>Future Contracts</h2>
        <span id="rightspan">To edit future click on the table row</span><br>
    </div>
    <!--futures form-->
    <form id="futures_form" method="post" action="processfut">
        <div id="left"> 
            <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
            <input id="manage" type="hidden" value="futures"/>
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
    <!--END futures form-->
    <span id="to_bottom"><i class="fa fa-arrow-down"></i></span>
</div>
<script>
    function getValFutur(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        action = obj.value;
    }
</script>