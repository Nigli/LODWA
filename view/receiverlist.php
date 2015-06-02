<?php
use receiver\ReceiverDao,utils\Session;
$rec = ReceiverDao::GetActiveReceivers();
$type = ReceiverDao::GetTypes();
$user = Session::get('user_status');
$user=='3'?include 'admin/receiverlist.php':'';
?>
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