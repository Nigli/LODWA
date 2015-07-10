<form id="profile" method="post" action="processprof">
    <input id="note" type="hidden" value="<?php echo $this->notice ?>"/>
    <div id="top">
        <h2>Profile Information</h2>
    </div>
    <div id="left">
        <?php 
        if($this->sender) {
        ?>
            <input type="hidden" name="id_sender" value="<?php echo $this->sender->id_sender;?>"/>
            <p>Company Name:</p>
            <input class="readonly" name="company" type="text" value="<?php echo $this->sender->company_name;?>" readonly required=""/><br>
            <p>Website:</p>
            <input class="readonly" name="website" type="text" value="<?php echo $this->sender->company_website;?>" readonly required=""/><br>
            <p>Address:</p>
            <input class="readonly" name="address" type="text" value="<?php echo $this->sender->sender_address;?>" readonly required=""/><br>
            <p>Sender Name:</p>
            <input class="readonly" name="name" type="text" value="<?php echo $this->sender->sender_name;?>" readonly required=""/><br>
            <p>Sender Email:</p>
            <input class="readonly" name="email" type="email" value="<?php echo $this->sender->sender_email;?>" readonly required=""/><br>        
        <?php  
        }else {            
            ?>
            <span>There is no Profile info in database</span>
            <input type="hidden" name="id_sender" value=""/>
            <p>Company Name:</p>
            <input class="readonly" name="company" type="text" value="" readonly required=""/><br>
            <p>Website:</p>
            <input class="readonly" name="website" type="text" value="" readonly required=""/><br>
            <p>Address:</p>
            <input class="readonly" name="address" type="text" value="" readonly required=""/><br>
            <p>Sender Name:</p>
            <input class="readonly" name="name" type="text" value="" readonly required=""/><br>
            <p>Sender Email:</p>
            <input class="readonly" name="email" type="email" value="" readonly required=""/><br>    
        <?php
        }
        ?>
    </div>
    <div id="bottom">
        <?php $this->user_status==\utils\Enum::MANAGER?include $this->profile_buttons :''; ?>
    </div>
</form>