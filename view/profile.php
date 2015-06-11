<script src="js/profile.js" type="text/javascript"></script>
<form id="profile" method="post" action="processprof">
    <div id="top">
        <h2>Company Information</h2>
    </div>
    <div id="left">
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
</form>