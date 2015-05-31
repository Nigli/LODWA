<?php
use broker\Broker,broker\BrokerDAO,utils\Session;
$broker_token=md5(uniqid(rand(),true));
Session::set('broker_token', $broker_token);
$broker = new Broker(BrokerDAO::GetBrokerInfo());
?>
<script src="js/broker.js" type="text/javascript"></script>
<form id="profile">
    <input type="hidden" name="broker_token" value="<?php echo $broker_token ?>"/>
    <div id="top">
        <h2>Broker Information</h2>
    </div>
    <div id="left">
        <p>Broker Company Name:</p>
        <input class="readonly" type="text" value="<?php echo $broker->broker_company;?>" readonly/><br>
        <p>Broker Name:</p>
        <input class="readonly" type="text" value="<?php echo $broker->broker_to;?>" readonly/><br>
        <p>Broker Email:</p>
        <input class="readonly" type="text" value="<?php echo $broker->broker_email;?>" readonly/><br>
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <button id="change" class="change" type="button" value="change">Change</button>
            <button id="update" class="update" type="submit" value="update">Update</button>
        </div>
    </div>
</form>