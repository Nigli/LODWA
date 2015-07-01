<script src="js/profile.js" type="text/javascript"></script>
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
<!--END NOTICE POPUP-->
<form id="profile" method="post" action="processprof">
    <input id="profile_note" type="hidden" value="<?php echo $notice ?>"/>
    <div id="top">
        <h2>Profile Information</h2>
    </div>
    <div id="left">
        <?php 
        if($sender) {
        ?>
            <input type="hidden" name="id_sender" value="<?php echo $sender->id_sender;?>"/>
            <p>Company Name:</p>
            <input class="readonly" name="company" type="text" value="<?php echo $sender->company_name;?>" readonly required=""/><br>
            <p>Website:</p>
            <input class="readonly" name="website" type="text" value="<?php echo $sender->company_website;?>" readonly required=""/><br>
            <p>Address:</p>
            <input class="readonly" name="address" type="text" value="<?php echo $sender->sender_address;?>" readonly required=""/><br>
            <p>Sender Name:</p>
            <input class="readonly" name="name" type="text" value="<?php echo $sender->sender_name;?>" readonly required=""/><br>
            <p>Sender Email:</p>
            <input class="readonly" name="email" type="email" value="<?php echo $sender->sender_email;?>" readonly required=""/><br>                
    </div>
    <div id="bottom">
        <?php $user=='3'?include 'admin/profile.html':''; ?>
    </div>
    <?php  
        }else {
            
            ?>
            <span>There is no Profile info in database</span>
            </div>
            <div id="bottom"></div>
            <?php
        }
        ?>
</form>