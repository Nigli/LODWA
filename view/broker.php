<!-- broker form -->
<form id="profile" method="post"  action="processbrok">    
    <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
    <div id="top">
        <h2>Broker Information</h2>
    </div>
    <div id="left">
        <?php
        if ($this->broker) {
            ?>
            <input type="hidden" name="id_broker" value="<?php echo $this->broker->id_broker; ?>"/>
            <p>Broker Company Name:</p>
            <input class="readonly" name="company" type="text" value="<?php echo $this->broker->broker_company; ?>" readonly/><br>
            <p>Broker Name:</p>
            <input class="readonly" name="name" type="text" value="<?php echo $this->broker->broker_name; ?>" readonly/><br>
            <p>Broker Email:</p>
            <input class="readonly" name="email" type="text" value="<?php echo $this->broker->broker_email; ?>" readonly/><br> 
            <?php
        } else {
            ?>
            <span>There is no Broker info in database</span>
            <input type="hidden" name="id_broker" value=""/>
            <p>Broker Company Name:</p>
            <input class="readonly" name="company" type="text" value="" readonly/><br>
            <p>Broker Name:</p>
            <input class="readonly" name="name" type="text" value="" readonly/><br>
            <p>Broker Email:</p>
            <input class="readonly" name="email" type="text" value="" readonly/><br>
            <?php
        }
        ?>
    </div>
    <div id="bottom">
        <?php $this->user_status == \utils\Enum::MANAGER ? include $this->broker_button : ""; ?>
    </div>
</form>
<!--END broker form -->