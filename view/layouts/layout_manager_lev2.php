<!DOCTYPE HTML>
<html>
    <head>       
        <title>Northern Advisors LOD</title>
        <meta name="robots" content="noindex">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
        <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
        <link href="inc/style/style.css" rel="stylesheet" type="text/css"/>
        <link href="inc/style/spinner.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <link href="inc/style/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="inc/js/nav.js" type="text/javascript"></script>
        <script src="inc/js/manager.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="shade" class="shade"></div>
        <div id="header-outer">
            <div id="header-inner">
                <div id="logo">
                    <img src="inc/images/index.png" alt=""/>
                </div>
                <i class="fa fa-bars respons"></i>
                <div id="header-nav">
                    <ul>
                        <li><a href="trlist">Trade Recs</a></li>
                        <li><a href="receiverlist">Subscribers</a></li>
                        <li><a href="emailtemp">Email Temp</a></li>
                        <li class="settings">
                            <i class="fa fa-bars"></i>
                            <ul>
                                <li><a href="profile">Profile</a></li>
                                <li><a href="broker">Broker</a></li>                            
                                <li><a href="logout">LogOut</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper">            
            <div id="main">
                <div id="spinner"></div>
                <!--notice popup-->
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
                            <button id="notice-cancel" type="button" name="cancel">Cancel</button>         
                            <button id="notice-confirm" type="submit" name="name" form="form">Confirm</button>
                        </div>
                    </div>
                </div>
                <!--END notice popup-->
                [CONTENT]                
            </div>
        </div>        
    </body>
</html>