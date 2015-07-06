<script src="js/broker.js" type="text/javascript"></script>
<div id="spinner"></div>
<!--NOTICE POPUP-->
<div id="notice">
    <div id="top">
        <div id="notice-title">
            <h3></h3>
        </div>
    </div>
    <span id="notice-span"></span>
    <div id="bottom">
        <div id="bottom-left">            
            <button id="notice-close" type="button" name="close">Close</button>
        </div>
    </div>
</div>
<!--NOTICE POPUP-->
<form id="profile" method="post"  action="processbrok">    
    <input id="broker_note" type="hidden" value="<?php echo $this->notice ?>"/>
    <div id="top">
        <h2>Broker Information</h2>
    </div>
    <div id="left">
        <?php 
        if($this->broker) {
            ?>
        <input type="hidden" name="id_broker" value="<?php echo $this->broker->id_broker;?>"/>
        <p>Broker Company Name:</p>
        <input class="readonly" name="company" type="text" value="<?php echo $this->broker->broker_company;?>" readonly/><br>
        <p>Broker Name:</p>
        <input class="readonly" name="name" type="text" value="<?php echo $this->broker->broker_name;?>" readonly/><br>
        <p>Broker Email:</p>
        <input class="readonly" name="email" type="text" value="<?php echo $this->broker->broker_email;?>" readonly/><br>
    </div>
    <div id="bottom">
        <?php $this->user=='3'?include 'admin/broker.html':''; ?>
    </div>
    <?php  
        }else {
            
            ?>
            <span>There is no Broker info in database</span>
            </div>
            <div id="bottom"></div>
            <?php
        }
        ?>
</form>