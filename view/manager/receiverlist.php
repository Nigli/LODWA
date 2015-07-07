<form id="receiver_list_form" method="post" action="processrec">
    <input id="active" name="active" type="hidden" value=""/>
    <div id="top">
        <h2>Subscribers</h2>
        <span id="rightspan">To edit subscriber click on the table row</span><br><input id="id_receiver" type="hidden" name="id_receiver" value=""/>           
    </div> 
    <div id="left">
        <label for="receiver_type_id">Type</label><br>
        <select id="receiver_type_id" name="fk_receiver_type">
            <?php foreach ($this->type as $k => $v) {
                echo "<option value='" . $v['id_receiver_type'] . "'>" . $v['receiver_type_name'] . "</option>";
            } ?>
        </select><br>
        <label for="first_name">First Name *</label><br>
        <input id="first_name" name="first_name" type="text" value="" required="" placeholder="First Name"/><br>
        <label for="last_name">Last Name *</label><br>
        <input id="last_name" name="last_name" type="text" value="" required="" placeholder="Last Name"/><br>
        <label for="email">Email *</label><br>
        <input id="email" name="email" type="email" value="" required="" placeholder="Email"/><br>
    </div>
    <div id="right">
        <label for="subs_type">Strategy (Strategies) and # of Subscriptions *</label><br>
        <div id="subs_form">            
            <?php 
            if($this->strategies){
                foreach ($this->strategies as $k => $v) {
                    ?>
                    <div id='strat_check'>
                        <input id="strategy_type<?php echo $v->id_strategy ?>" type="checkbox" value="<?php echo $v->id_strategy ?>"/><label><?php echo $v->strategy_name ?></label>
                        <input id="strategy_subs<?php echo $v->id_strategy ?>" type="number" name="subs_info[<?php echo $v->id_strategy ?>]" value=""/><br>
                    </div>
                    <?php
                }
            }else {
                ?>
                    <span>No Trading Strategies in database</span>
                <?php
            }
            ?>
        </div>
        <label for="broker_acc">Broker Account and Na Number</label><br>
        <select id="broker_acc" name="broker_acc">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>        
        <input id="na_number" name="na_number" type="text" value="" placeholder="NA Number"/><br>
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <button form="receiver_list_form" id="reset" class="reset" type="reset" name="receiver-submit" value="reset">Clear</button>
            <button form="receiver_list_form" id="unsubs" class="delete" type="button" name="receiver-submit" value="unsubscribe" onclick="getVal(this)">Unsubscribe</button>
            <button form="receiver_list_form" id="update" class="update" type="button" name="receiver-submit" value="update" onclick="getVal(this)">Update</button>
            <button form="receiver_list_form" id="new" type="button" name="receiver-submit" value="new" onclick="getVal(this)">New</button>
        </div>
    </div>
    <span id="to_bottom" title="Go down"><i class="fa fa-arrow-down"></i></span>
</form>
<script>
    function getVal(obj) {
        document.getElementById("notice-confirm").value = obj.value;
        rec_action = obj.value;
    }
</script>