<!-- trresult form -->
<form id="trresult_form" method="post"  action="processtrresult">    
    <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
    <input id="manage" type="hidden" value="trresult"/>
    <input id="id_tr" type="hidden" name="id_tr" value=""/>
    <div id="top">
        <h2>TR Result</h2>
    </div>
    <div id="left">
        <label for="futures_name">Futures Name</label><br>
        <input id="futures_name" class="readonly" readonly><br>
        <label for="strat_symbol">Strategy Symbol</label><br>
        <input id="strat_symbol" class="readonly" readonly><br>
        <label for="entry_choice">Entry Choice</label><br>
        <input id="entry_choice" class="readonly" readonly><br>     

        <label for="result">Select Result for this TR</label>
        <select id="result" name="result">
            <option>TGTH</option>
            <option>STPH</option>
            <option>UNEX</option>
            <option>SCXL</option>
            <option>REPL</option>
            <option>TEST</option>
        </select>
    </div>
    <div id="right">
        <label for="entry_price">Entry Price</label><br>
        <input id="entry_price" class="readonly" readonly><br>
        <label for="price_target">Price Target</label><br>
        <input id="price_target" class="readonly" readonly><br>
        <label for="stop_loss">Stop Loss</label><br>
        <input id="stop_loss" class="readonly" readonly><br>
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <button id="update" class="change" name="tr-submit" type="button" value="change" onclick="getVal(this)">Set Result</button>
        </div>
    </div>
    <span id="to_bottom"><i class="fa fa-arrow-down"></i></span>
</form>
<!-- END trresult form -->
<script>
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        action = obj.value;
    }
    $(document).ready(function(){
        $("#id_tr").val("<?php echo $this->lastTR[0]->id_tr ?>");
        $("#futures_name").val("<?php echo $this->lastTR[0]->futures_name ?>");
        $("#strat_symbol").val("<?php echo $this->lastTR[0]->strategy_symbol ?>");
        $("#result").val("<?php echo $this->lastTR[0]->result ?>");        
        $("#entry_choice").val("<?php echo $this->lastTR[0]->entry_choice ?>");
        $("#entry_price").val("<?php echo $this->lastTR[0]->entry_price ?>");
        $("#price_target").val("<?php echo $this->lastTR[0]->price_target ?>");
        $("#stop_loss").val("<?php echo $this->lastTR[0]->stop_loss ?>");        
    });
</script>