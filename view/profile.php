<?php
use sender\SenderInfoDAO,sender\SenderInfo;
$sender = new SenderInfo(SenderInfoDAO::GetSenderInfo());
?>
<div id="profile">
    <div id="top">
        <h2>Company Information</h2>
    </div>
    <div id="left">    
        <p>Company Name:</p>
        <span><?php echo $sender->company_name;?></span><br>
        <p>Website:</p>
        <span><a href="http://<?php echo $sender->company_website;?>" target="_blank"><?php echo $sender->company_website;?></a></span><br>
        <p>Address:</p>
        <span><?php echo $sender->sender_address;?></span><br>
        <p>Sender Name:</p>
        <span><?php echo $sender->sender_from;?></span><br>
        <p>Sender Email:</p>
        <span><?php echo $sender->sender_email;?></span><br>        
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <a href=""><button id="profilechange" value="change">Change</button></a>
        </div>
    </div>
</div>
