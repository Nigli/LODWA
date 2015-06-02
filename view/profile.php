<?php
use sender\SenderInfoDAO,sender\SenderInfo,utils\Session;
$profile_token=md5(uniqid(rand(),true));
Session::set('profile_token', $profile_token);
$user = Session::get('user_status');
$sender = new SenderInfo(SenderInfoDAO::GetSenderInfo());
?>
<script src="js/profile.js" type="text/javascript"></script>
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
        <?php $user=='3'?include 'admin/profile.html':''; ?>
    </div>
</form>