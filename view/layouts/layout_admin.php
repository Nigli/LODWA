<!DOCTYPE HTML>
<html>
    <head>        
        <base href="//lodwa.dev" />
        <title>Northern Advisors LOD</title>
        <meta name="robots" content="noindex">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
        <link href="inc/style/style.css" rel="stylesheet" type="text/css"/>
        <link href="inc/style/spinner.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="inc/js/admin.js" type="text/javascript"></script>
    </head>
    <body>                
        <div id="shade" class="shade"></div>
        <div id="header-outer">
            <div id="header-inner">
                <div id="logo">
                    <img src="inc/images/index.png" alt=""/>
                </div>
                <div id="header-nav">
                    <ul>
                        <li><a href="logout">LogOut</a></li>
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
                            <button id="notice-confirm" type="submit" name="user-submit" form="user_list_form">Confirm</button>  
                        </div>
                    </div>
                </div>
                <!--END notice popup-->
                [CONTENT]                
            </div>
        </div>
    </body>
</html>