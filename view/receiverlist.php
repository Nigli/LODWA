<script src="js/receiver.js" type="text/javascript"></script>
<div id="spinner"></div>
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h3></h3>
        </div>
    </div>
    <span id="notice-span"></span>
    <form id="receiver_list_filter" method="get" class="hidden">
        <input id="receiver_note" type="hidden" value="<?php echo $notice ?>"/>
        <input type="hidden" value="1" name="page"/>
        <label for="receiver_list_type">By Subscriber Type</label><br>
        <select id="receiver_list_type" name="type">
            <option value="0">ALL</option>
            <?php foreach ($type as $k=>$v){
            ?>           
            <option value="<?php echo $v['id_receiver_type'] ?>"><?php echo $v['receiver_type'] ?></option>
            <?php
            }
            ?>
        </select>
    </form>
    <div id="bottom">
        <div id="bottom-left">
            <button id="notice-reset" class="reset" type="reset" value="reset">Reset</button>            
            <button id="notice-close" type="button" name="close">Close</button>
            <button id="notice-cancel" type="button" name="cancel">Cancel</button>
            <button id="notice-confirm-filter" type="submit" form="receiver_list_filter">Confirm</button>
            <button id="notice-confirm" type="submit" name="receiver-submit" form="receiver_list_form">Confirm</button>
        </div>
    </div>
</div>
<div id="receiver_list">  
    <h2>Subscribers List</h2>
    <span id="filterspan">Filter</span>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Type</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Date Added</th>
                <th>NA Number</th>
                <th>BA</th>
            </tr>
        </thead>
        <?php
        if($rec){
            foreach ($rec as $k=>$receiver) {
            ?>
                <tr>
                    <td data-title='Receiver Type'><?php echo $receiver->receiver_type ?></td>
                    <td data-title='First Name'><?php echo $receiver->first_name ?></td>
                    <td data-title='Last Name'><?php echo $receiver->last_name ?></td>
                    <td data-title='Email'><?php echo $receiver->email ?></td>
                    <td data-title='Date Added'><?php echo date("d M Y", strtotime($receiver->date_added))?></td>
                    <td data-title='NA Number'><?php echo $receiver->na_number ?></td>
                    <td data-title='BA'><?php echo $receiver->broker_account?"<i class='fa fa-check'></i>":"<i class='fa fa-times'></i>"?></td>                
                    <td data-title='Broker Account' class="td_hidden"><?php echo $receiver->broker_account?></td>                
                    <td data-title='Receiver Id' class="td_hidden"><?php echo $receiver->id_receiver ?></td>
                    <td data-title='Receiver Type Id' class="td_hidden"><?php echo $receiver->fk_receiver_type ?></td>
                </tr>
            <?php
            }
        }else{
        ?>
            <tr><td>No Subscribers in Database</td></tr>
        <?php
        }
        ?>
    </table>
    <?php
        echo $pagin->createLinks($links);
    ?>
</div>
<script>
    $("#receiver_list_type").val("<?php echo $links['type'] ?>");
</script>