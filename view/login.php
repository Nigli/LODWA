<?php
use utils\Session;
$login_token=md5(uniqid(rand(),true));
Session::set('login_token', $login_token);
?>
<div id="login">  
    <form method="post" action="process/process_login.php">
        <input type="hidden" name="login_token" value="<?php echo $login_token ?>"/>
        <div id="top">
            <h2>Please Log In</h2>  
        </div>
        <div id="left">
            <label for="email">Email address</label><br>
            <input id="email" type="email" name="email" required=""/><br>
            <label for="pass">Password</label><br>
            <input id="pass" type="password" name="pass" required=""/>
        </div>
        <div id="bottom">
            <div id="bottom-left">
                <button type="submit" id="loginbutton" value="LogIn">LogIn</button>
            </div>
        </div>
    </form>
</div>