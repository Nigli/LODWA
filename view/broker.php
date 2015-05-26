<?php
use broker\Broker,broker\BrokerDAO;
$broker = new Broker(BrokerDAO::GetBrokerInfo());
?>
<div id="profile">
<!--    <form method="post" action="processtr">-->
        <div id="top">
            <h2>Broker Information</h2>
        </div>
        <div id="left">



        <p>Broker Company Name:</p>
            <span contenteditable><?php echo $broker->broker_company;?></span><br>
            <p>Broker Name:</p>
            <span><?php echo $broker->broker_to;?></span><br>
            <p>Broker Email:</p>
            <span><?php echo $broker->broker_email;?></span><br>
        </div>
        <div id="bottom">
            <div id="bottom-left">
                <a href=""><button id="brokerchange" value="change">Change</button></a>
            </div>
        </div>
<!--    </form>-->
</div>
