<script src="js/profile.js" type="text/javascript"></script>
<form id="profile" method="post"  action="processbrok">
    <div id="top">
        <h2>Broker Information</h2>
    </div>
    <div id="left">
        <input type="hidden" name="id_broker" value="<?php echo $broker->id_broker;?>"/>
        <p>Broker Company Name:</p>
        <input class="readonly" name="company" type="text" value="<?php echo $broker->broker_company;?>" readonly/><br>
        <p>Broker Name:</p>
        <input class="readonly" name="name" type="text" value="<?php echo $broker->broker_name;?>" readonly/><br>
        <p>Broker Email:</p>
        <input class="readonly" name="email" type="text" value="<?php echo $broker->broker_email;?>" readonly/><br>
    </div>
    <div id="bottom">
        <?php $user=='3'?include 'admin/broker.html':''; ?>
    </div>
</form>