<?php
use receiver\ReceiverDao;
$rec = ReceiverDao::GetActiveReceivers();
$type = ReceiverDao::GetTypes();
?>
<script src="js/receiver.js" type="text/javascript"></script>
<form id="receiver_list_form" class="edit" method="post" action="process/process_receivers.php">
    <h2>Edit or add New</h2>
    <span id="rightspan">To edit receiver click on the table row</span><br>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>NA Number</th>
                <th>BA</th>
            </tr>
        </thead>
        <tr>
            <td><select id="type" name="type"><?php foreach ($type as $k=>$v){echo "<option>".$v['receiver_type']."</option>"; }?></select></td>
            <td><input id="first_name" name="first_name" type="text" value="" required=""/></td>
            <td><input id="last_name" name="last_name" type="text" value="" required=""/></td>
            <td><input id="email" name="email" type="email" value="" required=""/></td>
            <td><input id="na_number" name="na_number" type="text" value="" required=""/></td>
            <td><input id="broker_acc" name="broker_acc" type="checkbox"/></td>
        </tr>
    </table>
    <input id="id_receiver" type="hidden" name="id_receiver" value=""/>    
    <div id="bottom">
        <div id="bottom-left">
            <button id="reset" class="reset" type="reset" name="submit" value="reset">Clear</button>
            <button id="delete" class="delete" type="submit" name="submit" value="unsubscribe">Unsubscribe</button>
            <button id="update" class="update" type="submit" name="submit" value="update">Update</button>
            <button id="new" type="submit" name="submit" value="new">New</button>
        </div>
    </div>
</form>
<div id="receiver_list">  
    <h2>Receivers List</h2>
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
        foreach ($rec as $k=>$receiver) {
        ?>
            <tr>
                <td data-title='Receiver Type'><?php echo $receiver->receiver_type ?></td>
                <td data-title='First Name'><?php echo $receiver->first_name ?></td>
                <td data-title='Last Name'><?php echo $receiver->last_name ?></td>
                <td data-title='Email'><?php echo $receiver->email ?></td>
                <td data-title='Date Added'><?php echo date("d M Y", strtotime($receiver->date_added))?></td>
                <td data-title='NA Number'><?php echo $receiver->na_number ?></td>
                <td data-title='Broker Account'><?php echo $receiver->broker_account ?></td>                
                <td data-title='Receiver Id' class="td_hidden"><?php echo $receiver->id_receiver ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>