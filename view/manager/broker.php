<!-- broker form -->
<form id="broker_form" method="post" action="processbrok">    
    <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
    <input id="manage" type="hidden" value="broker"/>
    <div id="top">
        <h2>Broker Information</h2>
    </div>
    <div id="left">
        <input id="id_broker" type="hidden" name="id_broker" value=""/>
        <p>Broker Company Name:</p>
        <input id="broker_company" name="broker_company" type="text" required=""/><br>
        <p>Broker Name:</p>
        <input id="broker_name" name="broker_name" type="text" required=""/><br>
        <p>Broker Email:</p>
        <input id="broker_email" name="broker_email" type="email" required=""/><br> 
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <button id="reset" class="reset" type="reset" value="reset">Clear</button>
            <button id="delete" class="delete" type="button" value="delete" onclick="getVal(this)">Remove</button>
            <button id="update" class="update" type="button" value="update" onclick="getVal(this)">Update</button>
            <button id="new" type="button" value="new" onclick="getVal(this)">New</button>
        </div>
    </div>
</form>
<!-- END broker form -->
<script>
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        action = obj.value;
    }
</script>