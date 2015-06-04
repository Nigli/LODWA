<?php include"../initialize_view/login.php";?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Northern Advisors LOD</title>
        <meta name="robots" content="noindex">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="header-outer">
            <div id="header-inner">
                <div id="logo">
                    <a href=""><img src="images/index.png" alt=""/></a>
                </div>                
            </div>
        </div>
        <div id="wrapper">            
            <div id="main">
                <div id="login">  
                    <form method="post" action="loginprocess">
                        <input type="hidden" name="login_token" value="<?php echo $login_token ?>"/>
                        <div id="top">
                            <h2>Please Log In</h2>
                            <?php echo (isset($error)&&$error=='loginerror')?"<span id='rightspan' class='notice'>Your login credentials are not valid</span>":""; ?>
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
            </div>
            <footer></footer>
        </div>
    </body>
</html>