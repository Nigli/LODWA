<!DOCTYPE HTML>
<html>
    <head>        
        <title>TR</title>
        <meta name="robots" content="noindex">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
        <link href="inc/style/style.css" rel="stylesheet" type="text/css"/>
        <link href="inc/style/spinner.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <link href="inc/style/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="inc/js/nav.js" type="text/javascript"></script>
        <script src="inc/js/layout.js" type="text/javascript"></script>
    </head>
    <body>                
        <div id="shade" class="shade"></div>
        <div id="header-outer">
            <div id="header-inner">
                <div id="logo">
                    <img src="" alt=""/>
                </div>
                <i class="fa fa-bars respons"></i>
                <div id="header-nav">
                    <ul>
                        <li><a href="trade">New TR</a></li>
                        <li><a href="trlist">Trade Recs</a></li>
                        <li><a href="strategylist">Strategies</a></li>
                        <li><a href="futureslist">Futures</a></li>
                        <li><a href="receiverlist">Subscribers</a></li>
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
                        <span id="notice-span"></span>
                    </div>
                    <div id="left">
                        <span id="notice-entry-price" class="hidden"></span>
                        <span id="notice-stop-loss" class="hidden"></span>
                        <span id="notice-price-target" class="hidden"></span>

                        <span id="notice-rec-type" class="hidden"></span>
                        <span id="notice-rec-first_name" class="hidden"></span>
                        <span id="notice-rec-last_name" class="hidden"></span>
                        <span id="notice-rec-email" class="hidden"></span>
                        
                        <span id="notice-strat-strategy_name" class="hidden"></span>
                        <span id="notice-strat-strategy_symbol" class="hidden"></span>
                        <span id="notice-strat-auto_tr" class="hidden"></span>
                        <span id="notice-strat-num_tr_day" class="hidden"></span>
                        <span id="notice-strat-num_contracts" class="hidden"></span>
                        <span id="notice-strat-num_futures" class="hidden"></span>
                    </div>
                    <div id="right">
                        <span id="notice-rec-strat_info" class="hidden"></span>
                        <span id="notice-rec-broker_acc" class="hidden"></span>
                        <span id="notice-rec-na_number" class="hidden"></span>                       
                        
                        <span id="notice-strat-num_receivers" class="hidden"></span>
                        <span id="notice-strat-start_time" class="hidden"></span>
                        <span id="notice-strat-end_time" class="hidden"></span>
                        <span id="notice-strat-cxr_start_time" class="hidden"></span>
                        <span id="notice-strat-cxr_end_time" class="hidden"></span>
                    </div>
                    <div id="bottom">
                        <div id="bottom-left">              
                            <button id="notice-close" type="button" name="close">Close</button>
                            <button id="notice-cancel" type="button" name="cancel">Cancel</button>         
                            <button id="notice-confirm" type="submit" name="fk_tr_type" form="tr_form">Confirm</button>
                        </div>
                    </div>
                </div>
                <!--END notice popup-->
                [CONTENT]                
            </div>
        </div>
    </body>
</html>