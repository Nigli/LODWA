<?php
use receiver\ReceiverDao;
$rec = ReceiverDao::GetActiveReceivers();
$type = ReceiverDao::GetTypes();
?>
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
            <button id="reset" class="reset" type="reset" value="reset">Clear</button>
            <button id="delete" class="delete" type="submit" value="delete">Delete</button>
            <button id="update" class="update" type="submit" value="update">Update</button>
            <button id="new" type="submit" value="new">New</button>
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
<script>
    $("#receiver_list tbody tr").on("click", function () {
        $rec = {type:$(this).find("[data-title='Receiver Type']").html(),
                first_name:$(this).find("[data-title='First Name']").html(),
                last_name:$(this).find("[data-title='Last Name']").html(),
                email:$(this).find("[data-title='Email']").html(),
                date_added:$(this).find("[data-title='Date Added']").html(),
                na_number:$(this).find("[data-title='NA Number']").html(),
                broker_acc:$(this).find("[data-title='Broker Account']").html(),
                id_receiver:$(this).find("[data-title='Receiver Id']").html()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
            if($rec.broker_acc==1){
                $("#broker_acc").prop('checked', true);
            }else{
                $("#broker_acc").prop('checked', false);
            };
        });
        $("#receiver_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);
        
        $("#update").show();
        $("#delete").show();
        $("#reset").show();
        $("#new").hide();
    });    
    $("#reset").on("click",function(){
        $(this).hide();
        $("#update").hide();
        $("#delete").hide();
        $("#new").show();
        $("#id_receiver").val("");
    });
</script>