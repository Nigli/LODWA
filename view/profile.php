<?php
use sender\SenderInfoDAO,sender\SenderInfo,utils\Session;
$profile_token=md5(uniqid(rand(),true));
Session::set('profile_token', $profile_token);
$sender = new SenderInfo(SenderInfoDAO::GetSenderInfo());
?>
<form id="profile" method="post">
    <input type="hidden" name="profile_token" value="<?php echo $profile_token ?>"/>
    <div id="top">
        <h2>Company Information</h2>
    </div>
    <div id="left">
        <p>Company Name:</p>
        <input class="readonly" type="text" value="<?php echo $sender->company_name;?>" readonly/><br>
        <p>Website:</p>
        <input class="readonly" type="text" value="<?php echo $sender->company_website;?>" readonly/><br>
        <p>Address:</p>
        <input class="readonly" type="text" value="<?php echo $sender->sender_address;?>" readonly/><br>
        <p>Sender Name:</p>
        <input class="readonly" type="text" value="<?php echo $sender->sender_from;?>" readonly/><br>
        <p>Sender Email:</p>
        <input class="readonly" type="email" value="<?php echo $sender->sender_email;?>" readonly/><br>  
    </div>
    <div id="bottom">
        <div id="bottom-left">
            <button id="change" type="button" value="change">Change</button>
            <button id="update" type="submit" value="update">Update</button>
        </div>
    </div>
</form>
<script>
    $("#change").on("click",function(){
        $("#profile input").removeAttr("readonly").removeClass("readonly");
        $(this).hide();
        $("#update").show();
    });
</script>