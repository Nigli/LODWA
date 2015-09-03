<!DOCTYPE HTML>
<html>
    <head>
        <base href="//localhost/LODWA/" />
        <title>Northern Advisors LOD</title>
        <meta name="robots" content="noindex">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
        <link href="inc/style/style.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="header-outer">
            <div id="header-inner">
                <div id="logo">
                    <img src="inc/images/index.png" alt=""/>
                </div>                
            </div>
        </div>
        <div id="wrapper">            
            <div id="main">                
                <div id="unsub">
                    <!--unsubscribe form-->
                    <form method="post" action="unsubprocess">                        
                        <div id="top">
                            <h2>Subscription Information</h2>                            
                        </div>
                        <?php
                        if ($this->subscriber) {
                            /*                             * checking if receiver type is client so he can NOT unsubscribe * */
                            if ($this->subscriber->id_receiver_type == 1) {
                                ?>
                                <div id="left">
                                    <h4>Dear <?php echo $this->subscriber->first_name . " " . $this->subscriber->last_name ?></h4>
                                    <p>You are receiving this email because you opted to receive Northern Advisors Research Reports.</p>        
                                    <p>You are not able to unsubscribe from <?php echo $this->subscriber->receiver_type_name ?> list. For more info please visit our website:</p>
                                    <a href="http://www.northernadvisors.com"  target="_blank">www.northernadvisors.com</a>
                                    <p>Or write as an email to: <a href="mailto:peter.levant@northernadvisors.com?Subject=Unsubscribe%20<?php echo $this->subscriber->first_name . "%20" . $this->subscriber->last_name ?>">peter.levant@northernadvisors.com </a></p>
                                </div>
                                <div id="bottom">
                                    <div id="bottom-left"></div>
                                </div>
                                <?php
                            } else {

                                /*                                 * if receiver is NOT client he CAN be unsubscribed * */
                                ?>
                                <input type="hidden" name="id_receiver" value="<?php echo $this->subscriber->id_receiver ?>"/>
                                <input type="hidden" name="active" value="<?php echo $this->subscriber->active ?>"/>
                                <div id="left">
                                    <p>You are receiving this email because you opted to receive Northern Advisors Research Reports.</p>
                                    <p>You can unsubscribe from this list anytime you want by clicking on the "Unsubscribe" button bellow.</p>
                                    <h4>Notice!</h4>
                                    <p>After clicking on the Unsubscribe button, you will not receive our emails anymore.</p>
                                </div>
                                <div id="bottom">
                                    <div id="bottom-left">
                                        <button type="submit" id="unsubbutton" value="Unsubscribe">Unsubscribe</button>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {

                            /*                             * if his unsubscription went ok he is unsubscribed * */
                            ?>   
                            <div id="left">
                                <p>You have been successfully unsubscribed from our emails.</p>
                            </div>
                            <div id="bottom">
                                <div id="bottom-left"></div>
                            </div>
                        </form>
                        <!--END unsubscribe form-->
                        <?php
                    }
                    ?>
                </div>               
            </div>
        </div>
    </body>
</html>



